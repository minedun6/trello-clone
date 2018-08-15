<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Picker Example</title>
    <link rel="stylesheet" href="{{ mix('/symmetryk/css/app.css') }}">
</head>

<div id="app">
    <nav>
        <div class="bg-white flex items-center border">
            <div class="bg-blue py-2 px-8">
                @include('symmetryk.pages.logo', ['class' => 'fill-current text-white w-64'])
            </div>
            <div class="w-1/3 relative ml-6">
                <div class="absolute pin-y pin-l pl-3 flex items-center justify-center">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                         class="fill-current text-grey-dark h-6 w-6" style="transform: rotate(270deg)">
                        <path d="M19.222 0.031c-7.028 0-12.746 5.756-12.746 12.831 0 3.012 1.039 5.783 2.772 7.975l-8.832 8.891c-0.509 0.513-0.509 1.343 0 1.856 0.255 0.257 0.588 0.385 0.922 0.385s0.667-0.128 0.922-0.385l8.81-8.868c2.212 1.858 5.055 2.978 8.154 2.978 7.028 0 12.746-5.757 12.746-12.831s-5.718-12.831-12.746-12.831zM19.222 23.068c-5.591 0-10.139-4.578-10.139-10.206s4.548-10.206 10.139-10.206c5.59 0 10.138 4.578 10.138 10.206s-4.548 10.206-10.138 10.206z"></path>
                    </svg>
                </div>
                <input type="text"
                       class="w-full border border-grey-light bg-grey-lightest p-3 leading-normal shadow-inner w-full pl-8 pr-11">
                <div class="absolute pin-y pin-r pr-3 flex items-center justify-center">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                         class="fill-current text-grey-dark h-3 w-3 mr-2" viewBox="0 0 32 32">
                        <path d="M31.566 29.628l-13.632-13.631 13.625-13.625c0.534-0.534 0.534-1.4 0-1.934s-1.4-0.534-1.934 0l-13.625 13.625-13.625-13.625c-0.534-0.534-1.4-0.534-1.934 0s-0.534 1.4 0 1.934l13.625 13.625-13.632 13.631c-0.534 0.534-0.534 1.4 0 1.934s1.4 0.534 1.934 0l1.562-1.562c0 0 0 0 0.001-0.001l12.069-12.069 12.069 12.069c0.001 0.001 0.001 0.001 0.002 0.002l1.561 1.561c0.534 0.534 1.4 0.534 1.934 0s0.534-1.4 0-1.934z"></path>
                    </svg>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                         class="fill-current text-grey-dark h-3 w-3">
                        <path d="M0.036 5.047c0-0.427 0.211-0.846 0.6-1.095 0.61-0.392 1.425-0.219 1.821 0.385l14.068 21.477 12.993-21.439c0.374-0.618 1.183-0.818 1.806-0.447s0.826 1.173 0.452 1.788l-14.079 23.23c-0.233 0.385-0.652 0.625-1.105 0.633s-0.881-0.217-1.128-0.594l-15.216-23.23c-0.144-0.219-0.212-0.465-0.212-0.708z"></path>
                    </svg>

                </div>
            </div>
            <div class="flex ml-auto h-auto justify-between items-center self-auto">
                <div class="px-6 mr-2">
                    <a href="#" class="relative no-underline">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                             class="fill-current text-blue h-20 w-10">
                            <path d="M6.115 22.082h-1.139v-1.141c0-0.63-0.596-1.14-1.331-1.14s-1.331 0.51-1.331 1.14v1.14h-1.141c-0.63 0-1.141 0.596-1.141 1.331s0.511 1.33 1.141 1.33h1.14v1.141c0 0.63 0.785 1.14 1.52 1.14s1.14-0.51 1.14-1.14v-1.14h1.14c0.63 0 1.14-0.785 1.14-1.52s-0.51-1.14-1.141-1.14zM18.146 16.316c1.491-1.155 2.459-2.973 2.459-5.022 0-3.484-2.787-6.318-6.212-6.318-3.424 0-6.209 2.834-6.209 6.318 0 2.062 0.981 3.891 2.488 5.045-1.319 0.563-2.517 1.416-3.49 2.522-0.428 0.485-0.387 1.232 0.090 1.667s1.211 0.395 1.639-0.092c1.405-1.595 3.417-2.509 5.521-2.509 4.086 0 7.412 3.381 7.412 7.538 0 0.652 0.52 1.181 1.161 1.181s1.161-0.529 1.161-1.181c0-4.121-2.49-7.661-6.019-9.149zM14.393 15.249c-2.144 0-3.888-1.774-3.888-3.955s1.744-3.956 3.888-3.956c2.145 0 3.89 1.775 3.89 3.956s-1.745 3.955-3.89 3.955zM25.947 16.316c1.491-1.155 2.459-2.973 2.459-5.022 0-3.484-2.786-6.318-6.211-6.318-0.641 0-1.161 0.529-1.161 1.181s0.52 1.181 1.161 1.181c2.145 0 3.89 1.775 3.89 3.956s-1.745 3.955-3.89 3.955c-0.641 0-1.161 0.529-1.161 1.181 0 0.102 0.017 0.2 0.041 0.294 0 0.008-0.002 0.014-0.002 0.022 0 0.652 0.52 1.181 1.161 1.181 4.087 0 7.412 3.381 7.412 7.538 0 0.652 0.52 1.181 1.161 1.181s1.161-0.529 1.161-1.181c0-4.12-2.49-7.66-6.020-9.148z"></path>
                        </svg>
                    </a>
                </div>
                <div class="px-6 mr-2">
                    <a href="#" class="relative no-underline">
                        <span class="absolute rounded-full h-5 w-5 bg-red text-xs text-center text-white pin-r mt-4">4</span>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                             class="fill-current text-grey-darker h-20 w-8">
                            <path d="M28.036 21.349c-1.249-1.573-2.103-4.983-2.668-7.24-0.076-0.302-0.147-0.586-0.214-0.847l-0.029-0.113c-0.513-1.992-1.726-6.693-6-8.307 0.196-0.429 0.309-0.905 0.309-1.407 0-1.878-1.533-3.406-3.417-3.406-0.006 0-0.011 0.002-0.017 0.002s-0.011-0.002-0.017-0.002c-1.884 0-3.417 1.528-3.417 3.406 0 0.505 0.114 0.983 0.313 1.415-4.28 1.627-5.498 6.338-6.013 8.336l-0.019 0.076c-0.067 0.26-0.138 0.544-0.214 0.846-0.564 2.257-1.418 5.667-2.668 7.24-2.319 2.918-2.030 5.076-1.989 5.313 0.106 0.622 0.468 1.121 1.101 1.121h7.907c0.357 2.366 2.404 4.187 4.875 4.187 0.048 0 0.095-0.009 0.142-0.014 0.047 0.005 0.093 0.014 0.142 0.014 2.471 0 4.518-1.821 4.874-4.187h7.907c0.633 0 0.994-0.499 1.101-1.121 0.040-0.237 0.33-2.395-1.989-5.313zM15.983 4.252c-0.451 0-0.818-0.366-0.818-0.816s0.367-0.815 0.818-0.815c0.006 0 0.011-0.002 0.017-0.002s0.011 0.002 0.017 0.002c0.451 0 0.818 0.366 0.818 0.815s-0.367 0.816-0.818 0.816c-0.006 0-0.011 0.002-0.017 0.002s-0.011-0.002-0.017-0.002zM16.142 29.379c-0.049 0-0.095 0.009-0.142 0.014-0.047-0.005-0.093-0.014-0.142-0.014-1.031 0-1.907-0.67-2.217-1.596h4.716c-0.309 0.926-1.185 1.596-2.216 1.596zM4.597 25.122c0.191-0.561 0.705-1.284 1.405-2.165 1.598-2.011 2.496-5.6 3.153-8.221 0.074-0.296 0.143-0.574 0.209-0.828l0.020-0.076c0.878-3.405 2.359-6.88 6.638-6.949 4.234 0.069 5.671 3.356 6.587 6.911l0.030 0.114c0.065 0.255 0.135 0.533 0.209 0.829 0.656 2.621 1.555 6.21 3.153 8.222 0.702 0.882 1.213 1.607 1.404 2.164h-22.806z"></path>
                        </svg>
                    </a>
                </div>
                <div class="px-6 mr-2">
                    <a href="#" class="relative no-underline">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                             class="fill-current text-grey-darker h-20 w-8">
                            <path d="M25.506 22.996c0.027-0.053-0.053 0.029 0 0v0zM29.307 16.915c-0.004-0.038 0 0.039 0 0v0zM2.699 16.915c0 0.039 0.004-0.038 0 0v0zM6.5 22.996c0.052 0.029-0.014-0.059 0 0v0zM10.111 15.394c-0.735 0-1.33 0.596-1.33 1.33s0.595 1.33 1.33 1.33c0.735 0 1.33-0.596 1.33-1.33s-0.596-1.33-1.33-1.33zM21.895 11.213c-3.044 0-5.511 2.468-5.511 5.511s2.468 5.511 5.511 5.511 5.511-2.468 5.511-5.511-2.468-5.511-5.511-5.511zM21.895 19.575c-1.575 0-2.851-1.276-2.851-2.851s1.276-2.851 2.851-2.851c1.574 0 2.851 1.276 2.851 2.851s-1.277 2.851-2.851 2.851zM15.623 16.724c0-3.044-2.468-5.511-5.511-5.511s-5.511 2.468-5.511 5.511 2.468 5.511 5.511 5.511 5.511-2.468 5.511-5.511zM10.111 19.575c-1.575 0-2.851-1.276-2.851-2.851s1.276-2.851 2.851-2.851c1.574 0 2.851 1.276 2.851 2.851s-1.277 2.851-2.851 2.851zM31.968 16.831c-0.014-3.389-1.652-5.468-2.762-6.488 2.246-3.238 1.986-6.655 1.972-6.81-0.041-0.48-0.378-0.885-0.846-1.015s-0.961 0.047-1.253 0.433c-2.716 3.584-6.361 3.026-7.375 2.941-2.717-0.324-5.487-1.283-5.702-1.14-0.214-0.143-2.984 0.816-5.702 1.14-1.014 0.084-4.66 0.643-7.375-2.941-0.292-0.386-0.785-0.562-1.252-0.433-0.468 0.13-0.805 0.535-0.846 1.015-0.013 0.155-0.273 3.571 1.973 6.81-1.11 1.021-2.747 3.099-2.762 6.488-0.042 0.633-0.157 5.234 4.942 8.066 0.263 0.207 1.334 1.096 2.082 1.625 0.162 0.119 3.326 3.692 8.721 3.692h0.079c0.048 0 0.094-0.008 0.141-0.014 0.047 0.006 0.092 0.014 0.141 0.014h0.079c5.396 0 8.39-3.265 8.523-3.416 0.796-0.862 1.638-1.313 1.901-1.52 5.099-2.831 5.364-7.813 5.322-8.446zM25.506 22.996c-0.198 0.374-1.217 0.818-2.292 1.982-0.040 0.044-2.517 2.579-6.83 2.579h-0.76c-4.313 0-6.79-2.535-6.83-2.579-1.075-1.164-2.19-1.56-2.292-1.982-4.088-2.231-3.812-5.952-3.801-6.082 0-3.691 2.174-5.286 2.273-5.345 0.544-0.317 1.452-0.948 1.148-1.496-0.035-0.062-1.095-0.705-1.14-0.76-0.745-0.897-0.841-1.41-1.14-2.281 1.433 1.003 2.641 1.279 3.739 1.43 1.912 0.263 3.299-0.177 3.482-0.239 2.2-0.809 4.728-0.824 4.754-0.824 0.064 0 0.127-0.009 0.188-0.019 0.062 0.010 0.124 0.019 0.188 0.019 0.025 0 2.555 0.014 4.754 0.824 0.184 0.062 1.57 0.502 3.482 0.239 1.098-0.151 2.306-0.426 3.739-1.43-0.299 0.87-0.395 1.384-1.14 2.281-0.046 0.056-1.106 0.698-1.14 0.76-0.305 0.548 0.603 1.18 1.148 1.496 0.099 0.060 2.273 1.655 2.273 5.345 0.011 0.13 0.287 3.851-3.801 6.082zM13.487 23.369l2.377 2.538 2.374-2.538-2.374-2.21-2.377 2.21zM21.895 15.394c-0.735 0-1.33 0.596-1.33 1.33s0.595 1.33 1.33 1.33c0.735 0 1.33-0.596 1.33-1.33s-0.596-1.33-1.33-1.33z"></path>
                        </svg>
                    </a>
                </div>
                <div class="px-6 mr-2">
                    <a href="#" class="relative no-underline">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                             class="fill-current text-grey-darker h-20 w-8">
                            <path d="M7.064 31.387c-0.254 0-0.508-0.078-0.725-0.233-0.431-0.309-0.622-0.859-0.476-1.371l2.808-9.851-8.137-6.158c-0.423-0.32-0.6-0.875-0.441-1.383s0.554-1.123 1.083-1.141h10.263l3.281-9.786c0.172-0.504 0.641-0.845 1.17-0.85 0.004 0 0.008 0 0.011 0 0.525 0 0.994 0.331 1.175 0.828l3.485 9.808 10.175-0.010c0.53 0.009 0.996 0.353 1.164 0.858s0.002 1.063-0.415 1.391l-8.024 6.309 2.942 9.649c0.071 0.158 0.11 0.333 0.11 0.517 0 0.695-0.559 1.259-1.249 1.259-0.003 0-0.007 0-0.010 0-0.244 0-0.487-0.071-0.699-0.215l-8.439-5.732-8.334 5.886c-0.216 0.152-0.467 0.228-0.718 0.228zM4.977 13.909l5.883 4.532c0.414 0.313 0.593 0.851 0.45 1.352l-2.070 7.262 6.143-4.34c0.424-0.299 0.988-0.304 1.417-0.013l6.22 4.225-2.202-7.221c-0.152-0.498 0.017-1.039 0.425-1.361l5.398-4.437h-6.842c-0.518-0.009-1.122-0.675-1.3-1.165l-2.565-7.099-2.436 7.145c-0.168 0.493-0.404 1.102-0.921 1.119h-7.602z"></path>
                        </svg>
                    </a>
                </div>
                <div class="bg-blue px-6 relative inline-block icon-profile cursor-pointer">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                         class="fill-current text-white h-20 w-8">
                        <path d="M20.727 16.888c2.557-1.614 4.262-4.478 4.262-7.737 0-5.030-4.059-9.122-9.049-9.122s-9.049 4.092-9.049 9.122c0 3.278 1.723 6.155 4.303 7.764-5.604 2-9.631 7.395-9.631 13.723 0 0.737 0.593 1.335 1.324 1.335s1.323-0.598 1.323-1.335c0-6.554 5.289-11.886 11.789-11.886s11.789 5.332 11.789 11.886c0 0.737 0.593 1.335 1.323 1.335s1.323-0.598 1.323-1.335c0-6.356-4.064-11.771-9.709-13.75zM9.539 9.15c0-3.559 2.872-6.453 6.402-6.453s6.402 2.895 6.402 6.453c0 3.559-2.872 6.455-6.402 6.455s-6.402-2.896-6.402-6.455z"></path>
                    </svg>
                    <div class="absolute pin-r min-w-full rounded-l-lg border w-80 menu">
                        <div>
                            <div class="rounded-tl-lg hover:bg-blue hover:text-white border-b border-grey-lighter">
                                <a href="#" class="px-4 py-2 block text-grey-dark no-underline hover:text-white">
                                    <div class="flex items-center">
                                        <img src="https://avatars0.githubusercontent.com/u/4510058?s=400&u=fe9e720546afdd8df4b68a241952a92d33e910c8&v=4"
                                             class="w-12 h-12 rounded-full mr-3"
                                             alt="YBS">
                                        <div class="">
                                            <div class="text-2xl">
                                                Bobby R.Ralston
                                            </div>
                                            <div class="text-sm">
                                                Bobby@fleckens.hu
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="hover:bg-blue border-b border-grey-lighter">
                                <a href="#" class="px-4 py-2 block text-grey-dark no-underline hover:text-white">
                                    <div class="flex items-center">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="fill-current h-6 w-6 mr-3">
                                            <path d="M31.964 21.892v-7.602c0-2.376-1.528-3.801-3.801-3.801h-4.343c-0.486-2.612-2.796-4.598-5.57-4.598s-5.084 1.986-5.57 4.598h-3.522c-2.395 0-4.181 1.922-4.181 4.181v12.163c0 2.496 1.935 4.18 4.371 4.18h18.547c2.075 0 3.746-1.422 4.061-3.459 0.010-0.068 0.015-0.135 0.014-0.204l-0.005-5.459zM18.281 8.588c1.361 0 2.421 0.756 2.842 1.901h-5.683c0.421-1.145 1.481-1.901 2.842-1.901zM29.304 22.272v4.941c-0.162 0.81-0.674 1.14-1.52 1.14h-18.625c-0.95 0-1.52-0.549-1.52-1.52v-12.163c0-0.927 0.472-1.52 1.52-1.52h18.625c1.049 0.006 1.456 0.683 1.52 1.52 0.024 1.923 0 7.602 0 7.602zM3.457 23.412c-0.62-0.26-0.76-0.779-0.76-1.14v-12.543c0-0.997 0.551-1.52 1.52-1.52h7.982c0.677 0 1.307-0.81 1.307-1.481s-0.549-1.214-1.225-1.214h-1.828c0.324-1.126 1.158-1.867 2.506-1.867 1.173 0 2.324 0.403 2.891 1.423 0.326 0.587 1.072 0.802 1.664 0.478s0.808-1.062 0.482-1.65c-0.998-1.796-2.902-2.911-4.968-2.911-2.748 0-5.044 1.95-5.559 4.527h-3.343c-2.336 0-4.096 1.772-4.096 4.122v12.421c0 1.723 0.953 3.193 2.486 3.836 0.156 0.066 0.318 0.097 0.477 0.097 0.477 0 0.931-0.278 1.129-0.741 0.263-0.618-0.042-1.575-0.666-1.836z"></path>
                                        </svg>
                                        <span class="text-xl font-medium">
                                            Switch to manager
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="hover:bg-blue border-b border-grey-lighter">
                                <a href="#" class="px-4 py-2 block text-grey-dark no-underline hover:text-white">
                                    <div class="flex items-center">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="fill-current h-6 w-6 mr-3">
                                            <path d="M23.376 9.997v-2.74c0-4.016-3.55-7.219-7.602-7.219s-7.602 3.203-7.602 7.219v2.74c-1.899 0.384-3.421 2.154-3.421 4.116v13.824c0 2.219 1.819 4.024 4.055 4.024h13.935c2.237 0 4.056-1.805 4.056-4.024v-13.824c0-1.962-1.522-3.733-3.421-4.116zM10.833 7.258c0-2.58 2.337-4.561 4.941-4.561s4.941 1.981 4.941 4.561v2.661h-9.883v-2.661zM24.136 28.163c0 0.783-0.732 1.14-1.52 1.14h-13.684c-0.789 0-1.52-0.737-1.52-1.52v-13.684c0-0.783 0.731-1.52 1.52-1.52h13.684c0.789 0 1.52 0.737 1.52 1.52v14.064zM15.763 19.041c-2.023 0-3.41 1.753-3.41 3.728 0 0.533 0.004 1.121 0.236 1.602 0.308 0.638 1.087 0.911 1.741 0.61s0.933-1.061 0.625-1.699c-0.067-0.138-0.1-0.285-0.1-0.438 0-0.566 0.328-1.193 0.908-1.193 0.983 0 1.196 0.626 1.196 1.193 0 0.157-0.035 0.307-0.104 0.447-0.312 0.636-0.038 1.399 0.613 1.704 0.182 0.086 0.375 0.126 0.565 0.126 0.488 0 0.956-0.267 1.18-0.724 0.24-0.488 0.361-1.010 0.361-1.552 0-1.975-1.41-3.803-3.812-3.803z"></path>
                                        </svg>
                                        <span class="text-xl font-medium">
                                            Change password
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="hover:bg-blue border-b border-grey-lighter">
                                <a href="#" class="px-4 py-2 block text-grey-dark no-underline hover:text-white">
                                    <div class="flex items-center">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="fill-current h-6 w-6 mr-3">
                                            <path d="M17.675 20.335h-1.525c-0.044-0.159-0.094-0.315-0.149-0.469l1.018-0.597c0.611-0.358 0.817-1.146 0.46-1.759s-1.141-0.821-1.752-0.462l-1.022 0.599c-0.265-0.305-0.553-0.589-0.866-0.844l0.565-1.043c0.338-0.624 0.109-1.405-0.512-1.745s-1.4-0.109-1.738 0.515l-0.57 1.051c-0.244-0.078-0.495-0.143-0.75-0.193l-0.002-1.353c-0.001-0.699-0.596-1.301-1.329-1.301h-0.002c-0.734 0-1.328 0.629-1.327 1.328l0.002 1.32c-0.295 0.057-0.584 0.138-0.867 0.233l-0.589-1.082c-0.339-0.624-1.119-0.851-1.739-0.512-0.621 0.341-0.849 1.123-0.51 1.746l0.6 1.101c-0.161 0.135-0.318 0.277-0.468 0.427-0.128 0.128-0.245 0.265-0.361 0.401l-1.089-0.637c-0.612-0.357-1.395-0.149-1.752 0.466s-0.148 1.402 0.463 1.759l1.105 0.645c-0.088 0.258-0.163 0.519-0.221 0.786h-1.417c-0.708 0.001-1.135 0.673-1.135 1.384s0.428 1.277 1.135 1.277h1.358c0.067 0.392 0.166 0.772 0.295 1.139l-1.114 0.653c-0.611 0.358-0.817 1.146-0.46 1.76 0.238 0.409 0.667 0.638 1.108 0.638 0.22 0 0.442-0.056 0.645-0.175l1.106-0.648c0.252 0.294 0.525 0.571 0.823 0.819l-0.606 1.117c-0.338 0.624-0.11 1.405 0.512 1.745 0.195 0.106 0.405 0.157 0.612 0.157 0.454 0 0.894-0.242 1.126-0.671l0.597-1.099c0.275 0.092 0.556 0.168 0.846 0.225l0.001 1.477c0 0.682 0.595 1.227 1.329 1.227 0 0 0.001 0 0.001 0 0.734 0 1.328-0.539 1.328-1.222l-0.001-1.483c0.255-0.051 0.506-0.118 0.752-0.197l0.581 1.066c0.233 0.427 0.672 0.669 1.125 0.669 0.208 0 0.419-0.051 0.614-0.158 0.621-0.341 0.848-1.123 0.509-1.746l-0.577-1.058c0.19-0.155 0.375-0.32 0.551-0.497 0.109-0.109 0.207-0.226 0.307-0.341l1.037 0.606c0.203 0.118 0.424 0.174 0.644 0.174 0.441 0 0.87-0.229 1.108-0.639 0.356-0.614 0.149-1.402-0.463-1.759l-1.028-0.601c0.179-0.501 0.303-1.023 0.364-1.56l1.315 0.003c0.707 0 1.152-0.456 1.152-1.165 0-0.711-0.445-1.495-1.152-1.495zM13.32 24.301c-0.030 0.040-0.063 0.078-0.089 0.123-0.022 0.037-0.035 0.076-0.052 0.115-0.167 0.263-0.361 0.511-0.586 0.737-0.817 0.822-1.887 1.276-3.045 1.281-0.788-0.002-1.505-0.19-2.121-0.518-0.013-0.008-0.024-0.019-0.038-0.026-0.009-0.005-0.019-0.007-0.029-0.012-1.341-0.748-2.181-2.172-2.183-3.806-0.001-1.167 0.417-2.265 1.238-3.091s1.913-1.281 3.082-1.282c2.393 0 4.353 1.958 4.356 4.364 0.002 0.753-0.185 1.474-0.535 2.114zM1.33 23.376c-0.001 0 0.147 0.129 0.147 0.129l-0.147-0.129zM30.972 10.315c0 0-0.001 0-0.001 0l-1.298-0.417c0.018-0.207 0.028-0.413 0.027-0.619l1.159-0.223c0.696-0.134 1.154-0.807 1.022-1.504-0.131-0.698-0.801-1.155-1.497-1.021l-1.163 0.223c-0.148-0.376-0.324-0.74-0.534-1.085l0.881-0.794c0.528-0.476 0.572-1.288 0.1-1.816s-1.282-0.571-1.81-0.095l-0.889 0.8c-0.217-0.165-0.446-0.316-0.685-0.455l0.453-1.284c0.236-0.67-0.1-1.437-0.766-1.673-0.001 0-0.001 0-0.002 0-0.667-0.236-1.421 0.175-1.657 0.844l-0.442 1.252c-0.313-0.049-0.628-0.074-0.942-0.079l-0.194-1.216c-0.111-0.701-0.77-1.177-1.468-1.063-0.699 0.114-1.175 0.775-1.063 1.476l0.197 1.237c-0.197 0.074-0.392 0.154-0.584 0.246-0.163 0.079-0.319 0.167-0.475 0.257l-0.814-0.964c-0.458-0.54-1.266-0.606-1.807-0.146s-0.608 1.271-0.151 1.813l0.826 0.977c-0.211 0.266-0.407 0.544-0.578 0.84l-1.145-0.451c-0.667-0.235-1.379 0.059-1.615 0.729s0.072 1.517 0.738 1.753v0c0 0 0 0 0.002 0l1.167 0.367c-0.059 0.364-0.086 0.727-0.087 1.088l-1.268 0.244c-0.696 0.134-1.153 0.807-1.022 1.505 0.088 0.466 0.416 0.824 0.831 0.971 0.207 0.073 0.436 0.095 0.667 0.051l1.259-0.242c0.14 0.362 0.305 0.713 0.502 1.046l-0.945 0.85c-0.527 0.475-0.573 1.288-0.1 1.816 0.148 0.166 0.329 0.283 0.524 0.352 0.428 0.151 0.924 0.070 1.286-0.256l0.929-0.837c0.244 0.19 0.503 0.365 0.775 0.523l-0.472 1.337c-0.237 0.669 0.115 1.395 0.782 1.631 0 0 0.001 0 0.001 0 0.667 0.236 1.395-0.102 1.632-0.771l0.476-1.346c0.269 0.040 0.539 0.064 0.81 0.072l0.192 1.198c0.077 0.48 0.41 0.855 0.837 1.006 0.197 0.070 0.412 0.092 0.632 0.056 0.699-0.114 1.175-0.775 1.063-1.476l-0.19-1.19c0.231-0.083 0.461-0.176 0.685-0.284 0.139-0.067 0.271-0.144 0.404-0.219l0.775 0.918c0.151 0.179 0.341 0.306 0.549 0.379 0.415 0.147 0.896 0.075 1.259-0.232 0.541-0.46 0.608-1.271 0.151-1.813l-0.768-0.91c0.33-0.406 0.617-0.848 0.851-1.325l1.111 0.43c0.667 0.236 1.379-0.056 1.615-0.724s-0.068-1.523-0.735-1.759zM26.903 10.75c-0.25 0.71-0.667 1.328-1.211 1.814-0.042 0.028-0.086 0.053-0.125 0.087-0.033 0.028-0.058 0.060-0.087 0.091-0.245 0.192-0.51 0.361-0.798 0.499-1.045 0.501-2.206 0.572-3.299 0.19-0.741-0.265-1.354-0.682-1.825-1.197-0.010-0.012-0.017-0.025-0.027-0.038-0.007-0.008-0.016-0.014-0.024-0.021-1.013-1.152-1.33-2.775-0.786-4.315 0.389-1.101 1.15-1.996 2.2-2.5s2.231-0.569 3.334-0.179c2.256 0.8 3.448 3.3 2.648 5.568z"></path>
                                        </svg>
                                        <span class="text-xl font-medium">
                                            Settings
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="rounded-bl-lg hover:bg-blue">
                                <a href="#" class="px-4 py-2 block text-grey-dark no-underline hover:text-white">
                                    <div class="flex items-center">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="fill-current h-5 w-5 mr-3">
                                            <path d="M25.134 5.68c-0.695-0.558-1.705-0.444-2.259 0.254s-0.157 1.142 0.537 1.701c2.732 2.2 4.561 5.982 4.561 9.503 0 6.35-5.229 12.163-12.163 12.163-6.553 0-11.783-5.813-11.783-12.163 0-3.465 1.899-6.923 4.561-9.122 0.686-0.567 0.964-1.303 0.4-1.995s-1.576-0.793-2.262-0.226c-3.411 2.817-5.367 6.978-5.367 11.418 0 8.136 6.568 14.756 14.64 14.756s14.641-6.619 14.641-14.756c0-4.511-2.007-8.714-5.506-11.532zM16.19 16.757c0.888 0 1.14-0.626 1.14-1.52v-13.684c0-0.895-0.633-1.52-1.52-1.52-0.626 0-1.14 0.626-1.14 1.52v13.684c0 0.895 0.633 1.52 1.52 1.52z"></path>
                                        </svg>
                                        <span class="text-xl font-medium">
                                            Logout
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<script src="{{ mix('/symmetryk/js/app.js') }}"></script>
</body>
</html>