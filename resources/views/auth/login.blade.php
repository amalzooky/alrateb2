@extends('front.layouts.login')

<!------ Include the above in your HEAD tag ---------->
@section('content')

    <div id="mainwrap">
        <header>

            <ul id="menu">
                <li><a class="profile" href="{{route('student.login')}}" title="student">الطالب</a></li>
                <li><a class="resume" href="#resume" title="Resume">المعلم</a></li>

                <li><a class="contact" href="#contact" title="Contact">الموظف</a></li>
            </ul>
        </header>
        <div style="clear:both"></div>
        <div id="content">
            <div id="{{route('student.login')}}" class="section">
                <nav class="main-nav">
                    <ul>
                        <li><a class="signin" href="#2">Sign in</a></li>
                        <li><a class="signup" href="#2">Sign up</a></li>
                    </ul>
                </nav>

                <div class="user-modal">
                    <div class="user-modal-container">
                        <ul class="switcher">
                            <li><a href="#2">Sign in</a></li>
                            <li><a href="#2">New account</a></li>
                        </ul>

                        <div id="login">
                            <form class="form" ction="{{route('student.login')}}" method="post"
                                  novalidate>
                                @csrf
                                <p class="fieldset">
                                    <label class="image-replace email"  for="signin-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="signin-email" type="email" name="email"
                                           value="{{old('email')}}" id="email" placeholder="أدخل البريد الالكتروني ">
                                     @error('email')
                                    <span
                                        class="error-message">{{$message}}</span>
 @enderror
                                       
                                   

                                </p>

                                <p class="fieldset">
                                    <label class="image-replace password" for="signin-password">Password</label>
                                    <input class="full-width has-padding has-border" id="signin-password" name="password"
                                           type="password" placeholder="Password">
                                    <a href="#0" class="hide-password">Show</a>
                                      @error('password')
                                    <span class="error-message">{{$message}}</span>
                                    @enderror
                                </p>

                                 <fieldset>
                                            <input type="checkbox" name="remember_me" id="remember-me"
                                                   class="chk-remember">
                                            <label style="color: #000;" for="remember-me">تذكر دخولي</label>
                                        </fieldset>

                                <p class="fieldset">

                                  <button class="full-width" type="submit" ><i class="ft-unlock"></i>
                                    دخول
                                </button>
                                    {{-- <input class="full-width" type="submit" value="Login"> --}}
                                </p>
                            </form>

                            <p class="form-bottom-message"><a href="#0">Forgot your password?</a></p>
                            <!-- <a href="#0" class="close-form">Close</a> -->
                        </div>

                        <div id="signup">
                            <form class="form">
                                <p class="fieldset">
                                    <label class="image-replace username" for="signup-username">Username</label>
                                    <input class="full-width has-padding has-border" id="signup-username" type="text"
                                           placeholder="Username">
                                    <span class="error-message">Your username can only contain numeric and alphabetic symbols!</span>
                                </p>

                                <p class="fieldset">
                                    <label class="image-replace email" for="signup-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="signup-email" type="email"
                                           placeholder="E-mail">
                                    <span class="error-message">Enter a valid email address!</span>
                                </p>

                                <p class="fieldset">
                                    <label class="image-replace password" for="signup-password">Password</label>
                                    <input class="full-width has-padding has-border" id="signup-password"
                                           type="password" placeholder="Password">
                                    <a href="#0" class="hide-password">Show</a>
                                    <span
                                        class="error-message">Your password has to be at least 6 characters long!</span>
                                </p>

                                <p class="fieldset">
                                    <input type="checkbox" id="accept-terms">
                                    <label for="accept-terms">I agree to the <a class="accept-terms" href="#0">Terms</a></label>
                                </p>

                                <p class="fieldset">
                                    <input class="full-width has-padding" type="submit" value="Create account">
                                </p>
                            </form>

                            <!-- <a href="#0" class="cd-close-form">Close</a> -->
                        </div>

                        <div id="reset-password">
                            <p class="form-message">Lost your password? Please enter your email address.</br> You will
                                receive a link to create a new password.</p>

                            <form class="form">
                                <p class="fieldset">
                                    <label class="image-replace email" for="reset-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="reset-email" type="email"
                                           placeholder="E-mail">
                                    <span class="error-message">An account with this email does not exist!</span>
                                </p>

                                <p class="fieldset">
                                    <input class="full-width has-padding" type="submit" value="Reset password">
                                </p>
                            </form>

                            <p class="form-bottom-message"><a href="#0">Back to log-in</a></p>
                        </div>
                        <a href="#0" class="close-form">Close</a>
                    </div>
                </div>
            </div>

            <div id="resume" class="section">
                <nav class="main-nav">
                    <ul>
                        <li><a class="signin" href="#2">Sign in</a></li>
                        <li><a class="signup" href="#2">Sign up</a></li>
                    </ul>
                </nav>

                <div class="user-modal">
                    <div class="user-modal-container">
                        <ul class="switcher">
                            <li><a href="#2">Sign in</a></li>
                            <li><a href="#2">New account</a></li>
                        </ul>

                        <div id="login">
                             <form method="POST" action="{{route('admin.login')}}">
                        @csrf
                                <p class="fieldset">
                                    <label class="image-replace email" for="signin-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="signin-email" type="email"
                                           placeholder="E-mail">
                                    <span
                                        class="error-message">An account with this email address does not exist!</span>
                                </p>

                                <p class="fieldset">
                                    <label class="image-replace password" for="signin-password">Password</label>
                                    <input class="full-width has-padding has-border" id="signin-password"
                                           type="password" placeholder="Password">
                                    <a href="#0" class="hide-password">Show</a>
                                    <span class="error-message">Wrong password! Try again.</span>
                                </p>

                                <p class="fieldset">
                                    <input type="checkbox" id="remember-me" checked>
                                    <label for="remember-me">Remember me</label>
                                </p>

                                <p class="fieldset">
                                    <input class="full-width" type="submit" value="Login">
                                </p>
                            </form>

                            <p class="form-bottom-message"><a href="#0">Forgot your password?</a></p>
                            <!-- <a href="#0" class="close-form">Close</a> -->
                        </div>

                        <div id="signup">
                            <form class="form">
                                <p class="fieldset">
                                    <label class="image-replace username" for="signup-username">Username</label>
                                    <input class="full-width has-padding has-border" id="signup-username" type="text"
                                           placeholder="Username">
                                    <span class="error-message">Your username can only contain numeric and alphabetic symbols!</span>
                                </p>

                                <p class="fieldset">
                                    <label class="image-replace email" for="signup-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="signup-email" type="email"
                                           placeholder="E-mail">
                                    <span class="error-message">Enter a valid email address!</span>
                                </p>

                                <p class="fieldset">
                                    <label class="image-replace password" for="signup-password">Password</label>
                                    <input class="full-width has-padding has-border" id="signup-password"
                                           type="password" placeholder="Password">
                                    <a href="#0" class="hide-password">Show</a>
                                    <span
                                        class="error-message">Your password has to be at least 6 characters long!</span>
                                </p>

                                <p class="fieldset">
                                    <input type="checkbox" id="accept-terms">
                                    <label for="accept-terms">I agree to the <a class="accept-terms" href="#0">Terms</a></label>
                                </p>

                                <p class="fieldset">
                                    <input class="full-width has-padding" type="submit" value="Create account">
                                </p>
                            </form>

                            <!-- <a href="#0" class="cd-close-form">Close</a> -->
                        </div>

                        <div id="reset-password">
                            <p class="form-message">Lost your password? Please enter your email address.</br> You will
                                receive a link to create a new password.</p>

                            <form class="form">
                                <p class="fieldset">
                                    <label class="image-replace email" for="reset-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="reset-email" type="email"
                                           placeholder="E-mail">
                                    <span class="error-message">An account with this email does not exist!</span>
                                </p>

                                <p class="fieldset">
                                    <input class="full-width has-padding" type="submit" value="Reset password">
                                </p>
                            </form>

                            <p class="form-bottom-message"><a href="#0">Back to log-in</a></p>
                        </div>
                        <a href="#0" class="close-form">Close</a>
                    </div>
                </div>

            </div>

            <div id="contact" class="section">
                <nav class="main-nav">
                    <ul>
                        <li><a class="signin" href="#1">Sign in</a></li>
                        <li><a class="signup" href="#1">Sign up</a></li>
                    </ul>
                </nav>

                <div class="user-modal">
                    <div class="user-modal-container">
                        <ul class="switcher">
                            <li><a href="#1">Sign in</a></li>
                            <li><a href="#1">New account</a></li>
                        </ul>

                        <div id="login">
                            <form class="form">
                                <p class="fieldset">
                                    <label class="image-replace email" for="signin-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="signin-email" type="email"
                                           placeholder="E-mail">
                                    <span
                                        class="error-message">An account with this email address does not exist!</span>
                                </p>

                                <p class="fieldset">
                                    <label class="image-replace password" for="signin-password">Password</label>
                                    <input class="full-width has-padding has-border" id="signin-password"
                                           type="password" placeholder="Password">
                                    <a href="#0" class="hide-password">Show</a>
                                    <span class="error-message">Wrong password! Try again.</span>
                                </p>

                                <p class="fieldset">
                                    <input type="checkbox" id="remember-me" checked>
                                    <label for="remember-me">Remember me</label>
                                </p>

                                <p class="fieldset">
                                    <input class="full-width" type="submit" value="Login">
                                </p>
                            </form>

                            <p class="form-bottom-message"><a href="#0">Forgot your password?</a></p>
                            <!-- <a href="#0" class="close-form">Close</a> -->
                        </div>

                        <div id="signup">
                            <form class="form">
                                <p class="fieldset">
                                    <label class="image-replace username" for="signup-username">Username</label>
                                    <input class="full-width has-padding has-border" id="signup-username" type="text"
                                           placeholder="Username">
                                    <span class="error-message">Your username can only contain numeric and alphabetic symbols!</span>
                                </p>

                                <p class="fieldset">
                                    <label class="image-replace email" for="signup-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="signup-email" type="email"
                                           placeholder="E-mail">
                                    <span class="error-message">Enter a valid email address!</span>
                                </p>

                                <p class="fieldset">
                                    <label class="image-replace password" for="signup-password">Password</label>
                                    <input class="full-width has-padding has-border" id="signup-password"
                                           type="password" placeholder="Password">
                                    <a href="#0" class="hide-password">Show</a>
                                    <span
                                        class="error-message">Your password has to be at least 6 characters long!</span>
                                </p>

                                <p class="fieldset">
                                    <input type="checkbox" id="accept-terms">
                                    <label for="accept-terms">I agree to the <a class="accept-terms" href="#0">Terms</a></label>
                                </p>

                                <p class="fieldset">
                                    <input class="full-width has-padding" type="submit" value="Create account">
                                </p>
                            </form>

                            <!-- <a href="#0" class="cd-close-form">Close</a> -->
                        </div>

                        <div id="reset-password">
                            <p class="form-message">Lost your password? Please enter your email address.</br> You will
                                receive a link to create a new password.</p>

                            <form class="form">
                                <p class="fieldset">
                                    <label class="image-replace email" for="reset-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="reset-email" type="email"
                                           placeholder="E-mail">
                                    <span class="error-message">An account with this email does not exist!</span>
                                </p>

                                <p class="fieldset">
                                    <input class="full-width has-padding" type="submit" value="Reset password">
                                </p>
                            </form>

                            <p class="form-bottom-message"><a href="#0">Back to log-in</a></p>
                        </div>
                        <a href="#0" class="close-form">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
