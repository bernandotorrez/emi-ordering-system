
<div>
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        @if (session()->has('register_success'))
                            <div class="alert alert-success">
                                {{ session('register_success') }}
                            </div>
                        @endif

                        @if (session()->has('login_failed'))
                            <div class="alert alert-danger">
                                {{ session('login_failed') }}
                            </div>
                        @endif

                        <img src="{{ asset('assets/img/mazda-logo.png') }}" 
                        class="img-fluid w-50 h-50"
                        alt="Mazda" 
                        srcset="{{ asset('assets/img/mazda-logo.png') }}">

                        <form class="text-left" wire:submit.prevent="login">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USERNAME</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="username" name="username" type="text" class="form-control" maxlength="50"
                                        placeholder="e.g Bernand.Hermawan" autocomplete="off" wire:model.lazy="username">
                                        @error('username') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control"
                                        maxlength="50" placeholder="Password" autocomplete="off" wire:model.lazy="password">
                                        @error('password') <span class="error">{{ $message }}</span> @enderror
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>

                                <div id="login-as-field" class="field-wrapper input">
                                    <label for="login-as">LOGIN AS</label>
                                    <select class="form-control" id="login-as" name="login-as" wire:model.lazy="loginAs">
                                        <option value="">- Choose Login As -</option>
                                        <option value="atpm">ATPM</option>
                                        <option value="dealer">Dealer</option>
                                    </select>
                                        @error('loginAs') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button class="btn btn-primary" id="login" wire:offline.attr="disabled">Log In</button>
                                    </div>
                                </div>

                                <!-- <p class="signup-link">Not registered ? <a href="{{ route('register.index') }}">Create
                                        an
                                        account</a></p> -->

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
