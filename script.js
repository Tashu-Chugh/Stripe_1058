async function register() {
    const username = document.getElementById('register-username').value;
    const password = document.getElementById('register-password').value;
    const response = await fetch('http://localhost:3000/register', { // Update with your backend URL
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ username, password }),
    });
    if (response.ok) {
      alert('Registration successful');
    } else {
      const errorData = await response.json();
      alert(`Registration failed: ${errorData.error}`);
    }
  }
  
  async function login() {
    const username = document.getElementById('login-username').value;
    const password = document.getElementById('login-password').value;
    const response = await fetch('http://localhost:3000/login', { // Update with your backend URL
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ username, password }),
    });
    if (response.ok) {
      document.getElementById('registration').style.display = 'none';
      document.getElementById('login').style.display = 'none';
      document.getElementById('payment').style.display = 'block';
      alert('Login successful');
    } else {
      const errorData = await response.json();
      alert(`Login failed: ${errorData.error}`);
    }
  }
  
  async function makePayment() {
    const amount = parseInt(document.getElementById('payment-amount').value);
    const response = await fetch('http://localhost:3000/charge', { // Update with your backend URL
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ amount, currency: 'usd', description: 'Test Payment' }),
    });
    const data = await response.json();
    const { clientSecret } = data;
  
    const result = await stripe.confirmCardPayment(clientSecret, {
      payment_method: {
        card: elements.getElement('card'),
      },
    });
  
    if (result.error) {
      alert(`Payment failed: ${result.error.message}`);
    } else {
      alert('Payment successful');
    }
  }
  
  // Replace with your Stripe publishable key
  const stripe = Stripe('your-stripe-publishable-key');
  const elements = stripe.elements();
  