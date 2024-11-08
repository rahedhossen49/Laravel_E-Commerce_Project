<?php

if (!function_exists('getProfileImage')) {
    function getProfileImage($guard = 'web', $name = null)
    {
        if ($name) {
            return "https://api.dicebear.com/9.x/initials/svg?seed=" . urlencode($name) . "&backgroundcolor=696cff";
        }

        $user = auth($guard)->user();

        if ($user) {
            return $user->profile ?? "https://api.dicebear.com/9.x/initials/svg?seed=" . urlencode($user->name) . "&backgroundcolor=696cff";
        }

        return "https://api.dicebear.com/9.x/initials/svg?seed=guest&backgroundcolor=696cff"; // or any default name
    }
}














// if (!function_exists('getProfileImage')) {
//   function getProfileImage($guard = 'web',$name = null){

//     if ($name) {

//         return "https://api.dicebear.com/9.x/initials/svg?seed=" . $name . "&backgroundcolor=696cff";
//          die();
//     }
//       if (auth($guard)->user()?->profile) {
//        return auth()->user()->profile;
//       }else {
//         return "https://api.dicebear.com/9.x/initials/svg?seed=" . auth($guard)?->user()?->name . "&backgroundcolor=696cff";
//       }
//   }
// }





?>
