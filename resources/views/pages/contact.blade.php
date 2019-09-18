@extends('layouts.app')

@section('title', ' | ', $title)

@section('content')
    <div class="octo-content">
        <div class="container">
            <div class="row">
                <div class="contact">
            		<div class="container">
            			<div class="row">

            				<!-- Contact Info -->
            				<div class="col-lg-4">
            					<div class="contact_info_container">
            						<div class="contact_title">Contact Info</div>
            						<div class="contact_text">
            							<p>Octo Blogs is simple blog application created using laravel. Here you can post tutorials, personal writings, threads, news, etc. It is specifically designed for the people of Nepal, but is open to everyone.</p>
            						</div>

            					</div>
            				</div>

            				<!-- Contact Form -->
            				<div class="col-lg-8 contact_form_col">
            					<div class="contact_form_container">
            						<div class="contact_title">Get in touch</div>
            						<form action="#" class="contact_form" id="contact_form">
            							<div class="row contact_row">
            								<div class="col-lg-6"><input type="text" class="contact_input" placeholder="Name" required="required"></div>
            								<div class="col-lg-6"><input type="email" class="contact_input" placeholder="E-mail" required="required"></div>
            								<div class="col-12"><input type="text" class="contact_input" placeholder="Subject" required="required"></div>
            								<div class="col-12"><textarea class="contact_input contact_textarea" placeholder="Message" required="required"></textarea></div>
            							</div>
            							<button class="contact_button trans_200">send</button>
            						</form>
            					</div>
            				</div>
            			</div>
            			<div class="row google_map_row">
            				<div class="col">

            					<!-- Contact Map -->

            					<div class="contact_map">

            						<!-- Google Map -->

            						<div class="map">
            							<div id="google_map" class="google_map">
            								<div class="map_container">
            									<div id="map">
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3594581.03271322!2d81.88677396903611!3d28.37900732860538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995e8c77d2e68cf%3A0x34a29abcd0cc86de!2z4KSo4KWH4KSq4KS-4KSy!5e0!3m2!1sne!2snp!4v1547220163539" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                </div>
            								</div>
            							</div>
            						</div>

            					</div>

            				</div>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>

@endsection
