<div class="account-content checkout-staps">
          <div class="staps">
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="checkout-stap ">
                  <div class="title"> <span class="stap">1 </span><a href="{{ url('pengiriman/'.$id_order) }}">Alamat Pengiriman</a></div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="checkout-stap active">
                  <div class="title"><span class="stap">2 </span>
                    <a href="{{ url('pengiriman/metode/order/'.$id_order.'/alamat/'.$id_alamat) }}">Metode Pengiriman</a></div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="checkout-stap ">
                  <div class="title"><span class="stap">3 </span><a href="checkout-step3.html">Payment Method</a></div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="checkout-stap">
                  <div class="title"><span class="stap">4 </span><a href="checkout-step4.html">Order</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>