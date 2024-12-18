<style>
.gradient-background {
  width: 100%;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: linear-gradient(to right, #A1D8D8, #088178);
  position: relative;
  padding-top: 70px;
}

.add-confirmation, .add-alert {
  width: 300px;
  height: 90px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 5px;
  padding: 15px 15px 15px 20px;
  position: absolute;
  top: 90px; 
  left: 50%;
  transform: translateX(-50%);
  z-index: 10;
}

.add-confirmation {
  background-color: #f1f1f1;
  border-bottom: 3px solid #088178;
}

.add-alert {
  background-color: #fff;
  border-bottom: 3px solid #d32f2f;
}

.add-confirmation .icon, .add-alert .icon {
  width: 15%;
}

.add-confirmation .icon i, .add-alert .icon i {
  color: #fff;
  padding: 10px;
  border-radius: 50%;
}

.add-confirmation .icon i {
  background: #088178;
}

.add-alert .icon i {
  background: #d32f2f;
}

.add-confirmation .confirmation-message, .add-alert .alert-message {
  width: 85%;
}

.payment-container {
  max-width: 720px;
  width: 100%;
  background: #fff;
  border-radius: 5px;
  padding: 30px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  margin-top: 120px;
}

.payment-container .payment-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 30px;
}

.payment-wrapper .section-title {
  text-transform: uppercase;
  margin-bottom: 32px;
}

.payment-wrapper label {
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
  text-align: left;
}

.payment-wrapper input {
  width: 100%;
  height: 40px;
  font-size: 16px;
  padding: 0 12px;
  border-radius: 5px;
  border: 2px solid #d2d2d2;
  outline: none;
  margin-bottom: 15px;
}

.payment-wrapper input:focus {
  border-color: #088178;
}

.payment-wrapper input:focus::-webkit-input-placeholder {
  color: #088178;
  opacity: 0.5;
}

.payment-wrapper .input-group {
  display: flex;
  justify-content: space-between;
  gap: 12px;
}

.payment-wrapper .card-images {
  margin-bottom: 15px;
  display: flex;
  gap: 12px;
}

.payment-wrapper .card-images .card-icon {
  width: 60px;
  aspect-ratio: 3/2;
  object-fit: contain;
}

.payment-container .button {
  width: 100%;
  height: 40px;
  background: #088178;
  border-radius: 5px;
  border: none;
  outline: none;
  font-size: 18px;
  color: #fff;
  cursor: pointer;
  transition: 0.3s ease;
}

.payment-container .button:hover {
  background: #065f58;
}

@media screen and (max-width: 768px) {
  .payment-container {
    max-width: 90%;
    padding: 30px 12px;
    margin: 20px 0;
  }

  .payment-container .payment-wrapper {
    flex-direction: column;
  }

  .payment-wrapper .card-images .card-icon {
    width: 50px;
  }
}
</style>


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