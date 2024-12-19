<div class="gradient-background">
    <div class="payment-container">
      <form action="/project%20final%20de%20poles/Payment/processPayment" method="post">
        <div class="payment-wrapper">
          <div class="billing-info">
            <h3 class="section-title">Billing Address</h3>
            <label for="name">Full Name:</label>
            <input type="text" id="name" placeholder="Enter Your Name">

            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Enter Your Email">

            <label for="address">Address:</label>
            <input type="text" id="address" placeholder="Enter Your Address">

            <label for="country">Country:</label>
            <input type="text" id="country" placeholder="Enter Your Country">

            <div class="input-group">
              <div class="input-item">
                <label for="state">State:</label>
                <input type="text" id="state" placeholder="Enter Your State">
              </div>
              <div class="input-item">
                <label for="code">Postal Code:</label>
                <input type="number" id="code" placeholder="Enter Code">
              </div>
            </div>
          </div>

          <div class="payment-info">
            <h3 class="section-title">Payment</h3>
            <label>Card Accepted:</label>
            <div class="card-images">
              <a href="#"><img src="/project%20final%20de%20poles/public/assets/images/payment/paypal.jpeg" alt="paypal" class="card-icon"></a>
              <a href="#"><img src="/project%20final%20de%20poles/public/assets/images/payment/amerrican-express.png" alt="american express" class="card-icon"></a>
              <a href="#"><img src="/project%20final%20de%20poles/public/assets/images/payment/visa.jpg" alt="visa" class="card-icon"></a>
              <a href="#"><img src="/project%20final%20de%20poles/public/assets/images/payment/master_card.png" alt="master card" class="card-icon"></a>
            </div>

            <label for="cardholder">Cardholder Name:</label>
            <input type="text" id="cardholder" placeholder="Enter Cardholder Name">

            <label for="card-number">Card Number:</label>
            <input type="number" id="card-number" placeholder="Enter Your Card Number">

            <label for="cvc">CVC:</label>
            <input type="number" id="cvc" placeholder="Enter Your Card Verification Code">

            <div class="input-group">
              <div class="input-item">
                <label for="month">Expired Month:</label>
                <input type="text" id="month" placeholder="Expired Month">
              </div>
              <div class="input-item">
                <label for="year">Expired Year:</label>
                <input type="number" id="year" placeholder="Expired Year">
              </div>
            </div>
          </div>
        </div>
        <button class="button payment">Proceed To Payment</button>
      </form>
    </div>
  </div>