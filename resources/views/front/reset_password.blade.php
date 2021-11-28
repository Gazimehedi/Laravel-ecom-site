@extends('front.layout')
@section('page_title','Reset Password')
@section('container')
   {{-- <!-- catg header banner section -->
   <section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Fashion</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>         
           <li class="active">Women</li>
         </ol>
       </div>
      </div>
    </div>
   </section>
   <!-- / catg header banner section --> --}}
 
   <!-- Cart view section -->
 <section id="aa-myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="aa-myaccount-area">         
           <div class="row">
             <div class="col-md-6">
               <div class="aa-myaccount-register">                 
                <h4>Reset Password</h4>
                <form action="" id="frmReset" class="aa-login-form">
                  @csrf
                   <label for="password">Password<span>*</span></label>
                   <input type="password" placeholder="password" name="password" id="password" required>
                   <div id="password_error" class="error_msg"></div>
                   <button type="submit" id="btnRegistration" onclick="reset_password_proccess()" class="aa-browse-btn">Reset  <img id="reset_loading" style="display:none" width="20px" src="{{asset('front_assets/img/loading.gif')}}"></button> 
                 </form>
                 <div id="reset_success" style="clear:both"></div>
               </div>
             </div>
           </div>          
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Cart view section -->
@endsection