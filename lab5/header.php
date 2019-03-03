<!-- Author: J. Keith Owens
File Name: header.php
Created Date: 10/15/2018
Purpose: Serves as a navbar thats included on all pages for the registration page labs
JKO 10/15/2018 Original Build
-->

<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
  <button class="navbar-toggler navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#nav" aria-expanded="false">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse collapse" id="nav">
    <ul class="nav navbar-nav">
      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='login.php') print 'active'; ?>">
        <a class="nav-link" href="loginPage.php">Login <span class="sr-only"> (current)</span></a> </li>
      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='register.php') print 'active'; ?>">
        <a class="nav-link" href="lab5.php">Register </a>
      </li>
      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='Lab5HomePage.php') print 'active'; ?>">
        <a class="nav-link" href="Lab5HomePage.php">User Home </a>
      </li>
      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='logout.php') print 'active'; ?>">
        <a class="nav-link" href="Lab5LogOut.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
