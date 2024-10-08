@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>ทดสอบโมดัล</title>
</head>
<body>
    <style>
        .no-underline {
            text-decoration: none;
        }
    </style>
    
    <div class="container">
        <div class="admin-product-form-container">
            <form class="p-4 bg-light border rounded shadow">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center text-muted">
                        
                        
                    </div>
                    <h1 class="text-dark font-weight-bold">Total: ฿{{$subtotal}}</h1>
                </div>
    
                <div class="form-group mb-3">
                    <label for="email" class="text-muted">Email</label>
                    <input id="email" class="form-control" required type="email" name="email" placeholder="example@mail.com">
                </div>
                <div class="form-group mb-3">
                    <label for="phonenumber" class="text-muted">Phone number</label>
                    <input id="phonenumber" class="form-control" required type="text" name="phonenumber" placeholder="Your phone number">
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="text-muted">Full name</label>
                    <input id="name" class="form-control" required type="text" name="name" placeholder="Your full name">
                </div>
                
                <div class="form-group mb-3">
                    <label for="address2" class="text-muted">Address</label>
                    <input id="address2" class="form-control" type="text" name="address2" placeholder="Apartment, suite, etc.">
                </div>
                <div class="form-group mb-3">
                    <label for="district" class="text-muted">District</label>
                    <input id="district" class="form-control" required type="text" name="district" placeholder="District name">
                </div>
                <div class="form-group mb-3">
                    <label for="province" class="text-muted">Province</label>
                    <input id="province" class="form-control" required type="text" name="province" placeholder="Province name">
                </div>
    
                <hr class="my-4">
    
                <div class="container">
                    <form id="payment-method-form" class="p-4 bg-light border rounded shadow">
                        <div class="form-group mb-3">
                            <label class="text-muted mb-2">Payment Method</label>
                            <div id="payment-method">
                                <div>
                                    <input type="radio" id="card" name="payment_method" value="card">
                                    <label for="card">Credit/Debit Card</label>
                                </div>
                                <div>
                                    <input type="radio" id="cod" name="payment_method" value="cod">
                                    <label for="cod">Cash on Delivery (COD)</label>
                                </div>
                                <div>
                                    <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer">
                                    <label for="bank_transfer">Bank Transfer</label>
                                </div>
                            </div>
                        </div>
                
                        <div id="card-payment" class="StripeElement mb-4" style="display: none;">
                            <form id="payment-form">
                                <div id="card-element">
                                    <!-- Stripe.js จะฝังข้อมูลบัตรที่นี่ -->
                                </div>
                                <div id="card-errors" role="alert"></div>
                            </form>
                        </div>
                
                        <div id="bank-transfer-details" class="form-group" style="display: none;">
                            <label class="text-muted">Bank Account Details</label>
                            <p>Bank Name: Example Bank</p>
                            <p>Account Number: 123-456-7890</p>
                            <p>Account Name: Your Name</p>
                        </div>
                
                        
                    </form>
                </div>
                
                <script src="https://js.stripe.com/v3/"></script>
                <script>
                    // ตั้งค่า Stripe
                    var stripe = Stripe('pk_test_51Q0HcHLSCsVHaUfEhVAG6wp1DCvFdWWZuvVgTVCivTMhkvIVy8syDgAfLgqxdGNCFfCkPA3aPZse8D1UyR4fbwVS00oCI1w5qx');
                    var elements = stripe.elements();

                    // กำหนด style สำหรับ card element
                    var style = {
                        base: {
                            color: "#32325d",
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: "antialiased",
                            fontSize: "16px",
                            "::placeholder": {
                                color: "#aab7c4"
                            }
                        },
                        invalid: {
                            color: "#fa755a",
                            iconColor: "#fa755a"
                        }
                    };

                    // สร้าง card element และฝังเข้าไปใน <div id="card-element">
                    var card = elements.create("card", { style: style });
                    card.mount("#card-element");

                    // การแสดงผลส่วนฟอร์มตามวิธีการชำระเงินที่เลือก
                    document.getElementById("payment-method").addEventListener("change", function(event) {
                        var paymentMethod = event.target.value;
                        document.getElementById("card-payment").style.display = paymentMethod === "card" ? "block" : "none";
                        document.getElementById("bank-transfer-details").style.display = paymentMethod === "bank_transfer" ? "block" : "none";
                    });

                    // จัดการการส่งฟอร์ม
                    var paymentForm = document.getElementById("payment-method-form");
                    paymentForm.addEventListener("submit", function(event) {
                        event.preventDefault();
                        var selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;

                        if (selectedMethod === "card") {
                            // ถ้าเลือกชำระด้วยบัตร
                            stripe.createToken(card).then(function(result) {
                                if (result.error) {
                                    // แสดง error ถ้ามีปัญหา
                                    var errorElement = document.getElementById("card-errors");
                                    errorElement.textContent = result.error.message;
                                } else {
                                    // ส่ง token ไปยัง server
                                    stripeTokenHandler(result.token);
                                }
                            });
                        } else if (selectedMethod === "bank_transfer") {
                            // ถ้าเลือกโอนเงินผ่านธนาคาร
                            alert("Please transfer the amount to the bank account provided.");
                        } else if (selectedMethod === "cod") {
                            // ถ้าเลือกเก็บเงินปลายทาง
                            alert("Your order will be processed and collected upon delivery.");
                        }
                    });

                    // ส่ง token ไปยัง server
                    function stripeTokenHandler(token) {
                        // ส่ง token ไปยัง backend (เช่นผ่าน AJAX)
                        console.log("Token ที่ได้รับจาก Stripe:", token);
                        // ตัวอย่างการใช้:
                        // var hiddenInput = document.createElement('input');
                        // hiddenInput.setAttribute('type', 'hidden');
                        // hiddenInput.setAttribute('name', 'stripeToken');
                        // hiddenInput.setAttribute('value', token.id);
                        // paymentForm.appendChild(hiddenInput);

                        // ส่งฟอร์มไปยัง server
                        // paymentForm.submit();
                    }
                </script>




                <div class="my-5 md-3">
                    
                    <button type="button" class="btn btn-primary w-100" style="height: 60px;" data-toggle="modal" data-target="#successModal">
                        Pay ฿{{$subtotal}}
                    </button>
                </div>

                <!-- โมดัลแสดงความสำเร็จ -->
                <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">การสั่งซื้อสำเร็จ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                สั่งซื้อสินค้าเสร็จเรียบร้อยแล้ว
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                <button type="button" class="btn btn-primary" id="confirmOrderBtn">Home page</button>
                            </div>

                            <script>
                                document.getElementById('confirmOrderBtn').addEventListener('click', function() {
                                    window.location.href = '/welcome';
                                });


                            </script>

                        </div>
                    </div>
                </div>

                
            </form>
        </div>
    </div>
    
    @endsection
<!-- jQuery แบบเต็ม -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- JS ของ Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>



</body>
</html>