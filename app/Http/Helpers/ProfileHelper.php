<?php


if (!function_exists('getProfileImage')) {
  function getProfileImage(){
      if (auth()->user()?->profile) {
       return auth()->user()->profile;
      }else {
        return "https://api.dicebear.com/9.x/initials/svg?seed=" . auth()?->user()?->name . "&backgroundcolor=696cff";
      }
  }
}





?>