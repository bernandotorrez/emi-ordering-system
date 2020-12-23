<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0a1821;
            height: 100vh;
            width: 100vw;
            font-family: Roboto, Arial, sans-serif;
            color: #fff;
            text-align: center;
        }

        .not-found {
            width: 560px;
            height: 225px;
            margin-right: -10px;
        }

        .starry-sky {
            display: block;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        .search-icon {
            display: inline-block;
        }

        .notfound-copy {
            color: #fff;
            position: fixed;
            top: 25px;
            right: 10%;
            text-align: right;
        }

        h1 {
            font-weight: 700;
            font-size: 40px;
        }

        a {
            font-weight: 300;
            color: #fff;
            border-bottom: 1.5px solid #5581d4;
            text-decoration: none;
        }

        a:hover {
            font-weight: 300;
            color: #fff;
            border-bottom: 2px solid #fff;
            text-decoration: none;
        }

        /* change to alternating star opacities */
        .all-stars {
            animation: blinkblink 7s linear infinite;
        }

        @keyframes blinkblink {
            50% {
                opacity: 0.1;
            }
        }

        .moon {}

        input[type=text] {
            color: #fff;
            background-color: #0a1821;
            padding: 5px;
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 18px;
        }

        input[type=text]:focus {
            border-color: none;
            border-bottom: 2px solid #ccc;
        }

        @media (max-width: 647px) {
            .moon {
                padding-top: -500px;
            }
        }
    </style>
</head>

<body>
    <div class="notfound-copy">
        <svg aria-labelledby="404" alt="404 Page not found" class="not-found">
            <title id="svgtitle1">404 Page not found</title>
            <g class="404-text">
                <g opacity=".5" fill="#3B3D3D">
                    <path
                        d="M320.1 209.5c0 7.2-6 12.5-13.7 12.5s-13.7-5.4-13.7-12.5v-16.3h-43.8c-8.4 0-14.1-6.4-14.1-13.5 0-.8.8-4.4 2-7L275 84.5c2-4.8 7.2-7.8 12.3-7.8 6.8 0 13.7 6 13.7 12.9 0 1.2 0 2.6-.8 4.4-11.5 26.7-20.9 47.6-32.4 74.2h24.9v-30.4c0-7.2 6-12.5 13.7-12.5 7.4 0 13.7 5.4 13.7 12.5v30.4h2.6c7.6 0 13.3 5.8 13.3 12.3 0 7-5.8 12.5-13.3 12.5h-2.6v16.5zM436.9 123.9v54.7c0 24.3-16.3 43.6-46 43.6s-46-19.3-46-43.6v-54.7c0-26.3 13.9-47.4 46-47.4 32.1.1 46 21.2 46 47.4zm-64.3-1.4v56.1c0 11.3 6.4 19.1 18.3 19.1s18.3-7.8 18.3-19.1v-56.1c0-12.7-5.2-21.7-18.3-21.7s-18.3 9-18.3 21.7zM535 209.5c0 7.2-6 12.5-13.7 12.5s-13.7-5.4-13.7-12.5v-16.3h-43.8c-8.4 0-14.1-6.4-14.1-13.5 0-.8.8-4.4 2-7l38.2-88.2c2-4.8 7.2-7.8 12.3-7.8 6.8 0 13.7 6 13.7 12.9 0 1.2 0 2.6-.8 4.4-11.5 26.7-20.9 47.6-32.4 74.2h24.9v-30.4c0-7.2 6-12.5 13.7-12.5 7.4 0 13.7 5.4 13.7 12.5v30.4h2.6c7.6 0 13.3 5.8 13.3 12.3 0 7-5.8 12.5-13.3 12.5H535v16.5z" />
                </g>
                <g fill="#FFF">
                    <path
                        d="M326.4 197.5c0 7.2-6 12.5-13.7 12.5s-13.7-5.4-13.7-12.5v-16.3h-43.8c-8.4 0-14.1-6.4-14.1-13.5 0-.8.8-4.4 2-7l38.2-88.2c2-4.8 7.2-7.8 12.3-7.8 6.8 0 13.7 6 13.7 12.9 0 1.2 0 2.6-.8 4.4-11.5 26.7-20.9 47.6-32.4 74.2H299v-30.4c0-7.2 6-12.5 13.7-12.5 7.4 0 13.7 5.4 13.7 12.5v30.4h2.6c7.6 0 13.3 5.8 13.3 12.3 0 7-5.8 12.5-13.3 12.5h-2.6v16.5zM443.2 111.9v54.7c0 24.3-16.3 43.6-46 43.6s-46-19.3-46-43.6v-54.7c0-26.3 13.9-47.4 46-47.4 32.1.1 46 21.2 46 47.4zm-64.2-1.4v56.1c0 11.3 6.4 19.1 18.3 19.1s18.3-7.8 18.3-19.1v-56.1c0-12.7-5.2-21.7-18.3-21.7s-18.3 9-18.3 21.7zM541.4 197.5c0 7.2-6 12.5-13.7 12.5-7.8 0-13.7-5.4-13.7-12.5v-16.3h-43.8c-8.4 0-14.1-6.4-14.1-13.5 0-.8.8-4.4 2-7l38.2-88.2c2-4.8 7.2-7.8 12.3-7.8 6.8 0 13.7 6 13.7 12.9 0 1.2 0 2.6-.8 4.4-11.5 26.7-20.9 47.6-32.4 74.2H514v-30.4c0-7.2 6-12.5 13.7-12.5 7.4 0 13.7 5.4 13.7 12.5v30.4h2.6c7.6 0 13.3 5.8 13.3 12.3 0 7-5.8 12.5-13.3 12.5h-2.6v16.5z" />
                </g>
            </g>
        </svg>
        <h1>page not found</h1>
      
        <p><a href="{{route('home.index')}}">Take me Back!</a></p>
    </div>

    <svg aria-labelledby="Starry sky" alt="Starry sky" class="starry-sky">
        <title id="svgtitle2">Starry sky</title>
        <!-- STARS START -->
        <g class="all-stars" fill="#F6F5BC">
            <path class="stars-one"
                d="M148.9 151.5c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.7-6.2-6.2-6.2-6.2zM93.6 " />
            <path class="stars-two"
                d="M148.9 540.6c-4.9-1.6-6.2-6.2-6.2-6.2-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.8-.4-1zM526.3 551.7c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.7-6.2-6.2-6.2-6.2zM617.4 291.9c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.6-6.2-6.2-6.2-6.2zM681.9 42.7c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.7-6.2-6.2-6.2-6.2zM51.1 83.9c-.3-.3-.6-.4-1-.4s-.7.1-1 .4C47.5 88.8 43 90 43 90c-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5.1-1.6-6.3-6.1-6.3-6.1z" />
            <path class="all-stars"
                d="M148.9 151.5c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.7-6.2-6.2-6.2-6.2zM93.6 318.5c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.7-6.2-6.2-6.2-6.2zM132.3 169c-.2-.2-.4-.3-.6-.3s-.4.1-.6.3c-1 3.1-3.8 3.8-3.8 3.8-.2.2-.3.4-.3.6 0 .2.1.4.3.6 3.1 1 3.8 3.8 3.8 3.8.2.2.4.3.6.3s.4-.1.6-.3c1-3.1 3.8-3.8 3.8-3.8.2-.2.3-.4.3-.6 0-.2-.1-.4-.3-.6-3-.9-3.8-3.8-3.8-3.8zM585.9 269.5c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.7-6.2-6.2-6.2-6.2zM723.4 540.6c-4.9-1.6-6.2-6.2-6.2-6.2-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.8-.4-1zM526.3 551.7c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.7-6.2-6.2-6.2-6.2zM617.4 291.9c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.6-6.2-6.2-6.2-6.2zM681.9 42.7c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-1.6 4.9-6.2 6.2-6.2 6.2-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5-1.7-6.2-6.2-6.2-6.2zM51.1 83.9c-.3-.3-.6-.4-1-.4s-.7.1-1 .4C47.5 88.8 43 90 43 90c-.3.3-.4.6-.4 1s.1.7.4 1c4.9 1.6 6.2 6.2 6.2 6.2.3.3.6.4 1 .4s.7-.1 1-.4c1.6-4.9 6.2-6.2 6.2-6.2.3-.3.4-.6.4-1s-.1-.7-.4-1c-5.1-1.6-6.3-6.1-6.3-6.1z" />
        </g>
        <!-- Moon shadow -->
        <g class="moon">
            <path opacity=".5" fill="#3B3D3D" d="M122.7 373.9L-237.1 744l283.8 269.4 279.9-492.8z" />
            <!-- Moon color base -->
            <g fill="#D1D5D6">
                <path
                    d="M209 340.6c-70.9 0-128.4 57.5-128.4 128.4S138.1 597.4 209 597.4 337.4 539.9 337.4 469 279.9 340.6 209 340.6zm-41.9 176.1c0 10.9-8.9 19.8-19.8 19.8s-19.8-8.9-19.8-19.8c0-1.4.1-2.7.4-4-18.3-1.7-32.6-17-32.6-35.7 0-19.8 16.1-35.9 35.9-35.9 19.8 0 35.9 16.1 35.9 35.9 0 8.9-3.3 17.1-8.6 23.3 5.1 3.7 8.6 9.7 8.6 16.4zm20.2 3.9c0-8.8 7.1-16 16-16 8.8 0 16 7.1 16 16 0 8.8-7.1 16-16 16-8.9-.1-16-7.2-16-16zm5.8-43.5c0-13.3 10.7-24 24-24s24 10.7 24 24-10.7 24-24 24-24-10.8-24-24zm72.7 86.4c-4.2 0-8.2-.7-11.9-2-.5 12.8-11 23.1-24 23.1-13.3 0-24-10.7-24-24s10.7-24 24-24h1.1c-.7-2.9-1.1-5.8-1.1-8.9 0-19.8 16.1-35.9 35.9-35.9 19.8 0 35.9 16.1 35.9 35.9s-16.1 35.8-35.9 35.8zm10.9-91.1c0 2.6-2.1 4.6-4.6 4.6-2.6 0-4.6-2.1-4.6-4.6 0-2.6 2.1-4.6 4.6-4.6 2.5 0 4.6 2.1 4.6 4.6zm27.7 13.1c-2.1 2-4.9 3.2-8.1 3.2-6.5 0-11.7-5.2-11.7-11.7 0-6.5 5.2-11.7 11.7-11.7.5 0 1.1 0 1.6.1-1.5-3.6-3.2-7.1-5.1-10.5 2.5-4 3.9-8.7 3.9-13.8 0-14.6-11.8-26.4-26.4-26.4-3.6 0-7 .7-10.2 2-4.9-3.8-10.2-7.2-15.7-10.2.1 1 .2 2 .2 3.1 0 17.4-14.1 31.5-31.5 31.5-16.7 0-30.4-13-31.4-29.5 0-.7-.1-1.3-.1-2 0-3.4.5-6.6 1.5-9.6.9-2.8 2.2-5.5 3.8-7.9-2.2 0-4.3.1-6.5.2-3.8-6.7-11-11.2-19.2-11.2-11.8 0-21.5 9.3-22.1 21-17.1 7.5-32.1 18.8-43.9 32.8 14.3-50.3 60.6-87.2 115.6-87.2 66.3 0 120.1 53.8 120.1 120.1 0 29.5-10.6 56.4-28.2 77.3 3-10.5 4.6-21.5 4.6-32.9.1-9.1-.9-18.1-2.9-26.7z" />
                <circle cx="256.3" cy="384.3" r="14.1" />
            </g>
            <g fill="#FFF">
                <circle cx="217.1" cy="477.1" r="24" />
                <path
                    d="M265.8 491.7c-19.8 0-35.9 16.1-35.9 35.9 0 3.1.4 6.1 1.1 8.9h-1.1c-13.3 0-24 10.7-24 24s10.7 24 24 24c12.9 0 23.5-10.2 24-23.1 3.7 1.3 7.7 2 11.9 2 19.8 0 35.9-16.1 35.9-35.9s-16.1-35.8-35.9-35.8zM131.2 441.2c-19.8 0-35.9 16.1-35.9 35.9 0 18.7 14.3 34.1 32.6 35.7-.3 1.3-.4 2.6-.4 4 0 10.9 8.9 19.8 19.8 19.8s19.8-8.9 19.8-19.8c0-6.8-3.4-12.8-8.6-16.3 5.4-6.3 8.6-14.4 8.6-23.3 0-20-16.1-36-35.9-36z" />
                <path
                    d="M331 467.9c0-66.3-53.8-120.1-120.1-120.1-54.9 0-101.3 36.9-115.6 87.2 11.8-14.1 26.9-25.4 43.9-32.8.6-11.7 10.2-21 22.1-21 8.2 0 15.4 4.5 19.2 11.2 2.2-.1 4.3-.2 6.5-.2-1.6 2.4-2.9 5.1-3.8 7.9-1 3-1.5 6.3-1.5 9.6 0 .7 0 1.3.1 2 1 16.5 14.7 29.5 31.4 29.5 17.4 0 31.5-14.1 31.5-31.5 0-1-.1-2.1-.2-3.1 5.5 3 10.7 6.4 15.7 10.2 3.1-1.3 6.6-2 10.2-2 14.6 0 26.4 11.8 26.4 26.4 0 5-1.4 9.8-3.9 13.8 1.9 3.4 3.6 6.9 5.1 10.5-.5-.1-1.1-.1-1.6-.1-6.5 0-11.7 5.2-11.7 11.7 0 6.5 5.2 11.7 11.7 11.7 3.1 0 6-1.2 8.1-3.2 2 8.6 3 17.6 3 26.8 0 11.4-1.6 22.5-4.6 32.9 17.5-21 28.1-48 28.1-77.4z" />
                <circle cx="203.2" cy="520.6" r="16" />
                <circle cx="272.1" cy="472.4" r="4.6" />
            </g>
            <path opacity=".1" fill-rule="evenodd" clip-rule="evenodd" fill="#3B3D3D"
                d="M201.2 368.2l-.4-.8c-.4-.7-1.4-1-2.1-.6l-80.5 46.8c-.7.4-1 1.4-.6 2.1l.4.8c.3.5.8.8 1.4.8.3 0 .5-.1.8-.2l1-.6c0 .1.1.3.2.4l24.2 41.7c.2.4.7.7 1.2.7.2 0 .5-.1.7-.2l34.1-19.8c.3-.2.5-.5.6-.8.1-.4 0-.7-.1-1l-24.2-41.7-.3-.3 43.2-25.1c.4-.2.6-.5.7-1-.1-.4-.1-.8-.3-1.2z" />
            <!-- Flag stick -->
            <g>
                <path fill="#acacac" stroke="#B5B5B6" stroke-miterlimit="10"
                    d="M200.8 369.5c-.2.6-.8 1-1.4.8l-.9-.2c-.6-.2-1-.8-.8-1.4l25.5-89.5c.2-.6.8-1 1.4-.8l.9.2c.6.2 1 .8.8 1.4l-25.5 89.5z" />
                <path fill-rule="evenodd" clip-rule="evenodd" fill="#263563" stroke="#B5B5B6" stroke-miterlimit="10"
                    d="M262.9 334c-.1.5-.7.8-1.2.7l-46.4-13.2c-.5-.1-.8-.7-.7-1.2l10.8-38c.1-.5.7-.8 1.2-.7l46.4 13.2c.5.1.8.7.7 1.2l-10.8 38z" />
                <g fill-rule="evenodd" clip-rule="evenodd" fill="#263563">
                    <!-- #F9DA1E -->
                    <path
                        d="M249 311.1c.4.6.8 1.1 1.2 1.6.4.5.9.9.3 1.6.8.2 1.6.3 2.3.5-.1.4-.2.6-.2.9 0 .1.1.2.1.3.1-.1.2-.1.2-.2l.3-.9c.7.3 1.4.5 2.1.7.1-.8.1-.8 1-1.2.7-.3 1.3-.5 2-.8-.5-.7-.5-.7 0-1.3.1-.2.2-.4.4-.5-.5-.5-1.6.1-1.6-1.1-.4.3-.7.5-1 .7-.2.1-.4.1-.6.2 0-.2 0-.4.1-.6l.9-1.8c-.3.1-.6.1-.8.2-.2-.7-.3-1.3-.5-2-.5.5-1 .9-1.5 1.4l-.6-.6c-.1.8-.1 1.5-.2 2.3 0 .1-.1.3-.2.4-.1-.1-.3-.2-.3-.3-.2-.4-.3-.8-.5-1.2-.6.5-.6.5-1.3.2-.2-.1-.4-.1-.6-.2-.4.5.4 1.5-1 1.7z" />
                    <path
                        d="M260.2 298.6c-.6 1.1-1.2 2.2-1.8 3.4-.6 1.3-1.3 2.5-1.9 3.8-.4.8-.5.9-1.4.4.2-.8.4-1.6.5-2.4.1-.5.1-1 .2-1.5.1-1.8-1.4-3.7-3.2-3.9-.1 0-.4.2-.5.3-.9 1.6-1.7 3.3-2.5 5 0 .1-.1.2-.1.2-.2.2-.1.6-.6.4-.4-.2-.1-.4-.1-.7.2-.9.4-1.8.5-2.8 0-.7-.1-1.4-.3-2.1-.1-.4-.3-.5-.8-.4-1.8.7-3.3 1.7-4.5 3.1-2.5 2.6-4.3 5.6-5.2 9.1-.5 1.9-.5 3.8.3 5.6.8 1.7 1.2 1.8 2.8.8.7-.4 1.3-.9 2-1.4.3-.2.6-.3 1 0-1.2 1-2.4 2-3.7 2.9.7.6 1.6.8 2.6 1 2.5.4 4.6-.7 6.4-2.3.7-.6 1.2-.5 1.9-.2v.1c-2 2.2-4.2 4.1-7.3 4.3-2.3.2-4.4-.4-6.4-1.8-.2-.2-.5-.3-.8-.3-5.5.1-9.3-3.9-9-9.4 0-.7.1-1.4.2-2 .2-.6.4-1.3.5-1.9.1-.2.2-.3.3-.5.6-1.2 1.1-2.5 1.9-3.6 2.5-3.8 5.9-6.4 10.5-7.2 1.9-.3 3.9-.3 5.6.6 1.1.6 2.1.7 3.3.7.6 0 1.2.1 1.8.1.5.1.9.3 1.4.4.2.1.5.3.7.4.8.6 1.6 1.1 2.4 1.7.4.3.8.4 1.2.1.4-.2.7-.5 1.1-.7.3.5.7.6 1 .7zm-13.4-2c-.7-.5-2.1-.7-3.4-.6-2.1.2-3.8 1.2-5.3 2.4-2.4 2-4.2 4.6-5.5 7.5-.8 1.7-1.3 3.5-1.3 5.4 0 2.5.8 4.6 3.1 5.9.6.3 1.2.5 1.9.8 0-.1.1-.1.1-.2s-.1-.2-.1-.2c-1-1.5-1.4-3.1-1.4-4.9-.1-2.3.5-4.5 1.5-6.6 1.6-3.3 3.9-6.1 7.1-8 .9-.5 2.1-.9 3.3-1.5z" />
                    <path
                        d="M249 311.1c1.4-.1.5-1.1.8-1.8.2.1.4.1.6.2.7.3.7.3 1.3-.2.2.4.3.8.5 1.2l.3.3c.1-.1.2-.3.2-.4.1-.7.1-1.5.2-2.3l.6.6c.5-.4 1-.9 1.5-1.4.2.7.4 1.3.5 2 .3-.1.5-.1.8-.2-.3.7-.6 1.2-.9 1.8-.1.2-.1.4-.1.6.2-.1.4-.1.6-.2.3-.2.6-.4 1-.7 0 1.2 1.1.7 1.6 1.1-.1.2-.2.3-.4.5-.5.7-.5.7 0 1.3-.7.3-1.3.5-2 .8-.8.3-.8.3-1 1.2-.7-.2-1.3-.5-2.1-.7l-.3.9c0 .1-.2.2-.2.2 0-.1-.1-.2-.1-.3 0-.3.1-.5.2-.9-.7-.2-1.5-.3-2.3-.5.6-.7.1-1.2-.3-1.6-.1-.5-.5-1-1-1.5z" />
                </g>
            </g>
        </g>
    </svg>
</body>

</html>