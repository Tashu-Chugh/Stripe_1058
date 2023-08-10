// index.js

const express = require('express');
const bodyParser = require('body-parser');
const stripe = require('stripe')('YOUR_SECRET_KEY');

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

app.use(express.static('public'));

// Process payment
app.post('/process-payment', async (req, res) => {
  try {
    const token = req.body.token;
    // Create a charge using the token
    const charge = await stripe.charges.create({
      amount: 1000, // Amount in cents
      currency: 'usd',
      source: token,
      description: 'Payment for Basic Plan',
    });

    // If charge is successful, return a success response
    res.sendStatus(200);
  } catch (error) {
    console.error(error);
    res.status(500).json({ error: 'An error occurred while processing the payment.' });
  }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
