 <!--start header-->
 <script src="{{ asset('assets/js/app.js') }}"></script>

 <header class="top-header">
     <nav class="navbar navbar-expand align-items-center gap-4">
         <div class="btn-toggle">
             <a href="javascript:app.toggleMenu();"><i class="material-icons-outlined">menu</i></a>
         </div>
         <div class="search-bar flex-grow-1">
             <div class="position-relative">
                 <input class="form-control rounded-5 px-5 search-control d-lg-block d-none" type="text"
                     placeholder="Search">
                 <span
                     class="material-icons-outlined position-absolute d-lg-block d-none ms-3 translate-middle-y start-0 top-50">search</span>
                 <span
                     class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 search-close">close</span>
                 <div class="search-popup p-3">
                     <div class="card rounded-4 overflow-hidden">
                         <div class="card-header d-lg-none">
                             <div class="position-relative">
                                 <input class="form-control rounded-5 px-5 mobile-search-control" type="text"
                                     placeholder="Search">
                                 <span
                                     class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
                                 <span
                                     class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 mobile-search-close">close</span>
                             </div>
                         </div>
                         <div class="card-footer text-center bg-transparent">
                             <a href="javascript:void(0);" class="btn w-100">See All Search Results</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <ul class="navbar-nav gap-1 nav-right-links align-items-center">
             <li class="nav-item dropdown">
                 <a href="javascript:void(0);" class="dropdown-toggle dropdown-toggle-nocaret"
                     data-bs-toggle="dropdown">
                     <img src="{{ asset('assets/images/avatar1.png') }}" class="rounded-circle p-1 border" width="45"
                         height="45" alt="">
                 </a>
                 <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                     <a class="dropdown-item  gap-2 py-2" href="javascript:;">
                         <div class="text-center">
                             <img src="{{ asset('build/images/aku.png') }}" class="rounded-circle p-1 shadow mb-3"
                                 width="90" height="90" alt="">
                             <h5 class="user-name mb-0 fw-bold">Hello, {{ Auth::user()->name }}</h5>
                         </div>
                     </a>
                     <hr class="dropdown-divider">
                     <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                             class="material-icons-outlined">person_outline</i>Profile</a>
                     <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:void(0);"
                         onclick="document.getElementById('logout-form').submit()"><i
                             class="material-icons-outlined">power_settings_new</i>Logout</a>
                     <form action="{{ route('logout') }}" method="POST" id="logout-form">
                         @csrf
                     </form>
                 </div>
             </li>
         </ul>

     </nav>
 </header>
 <!--end top header-->
