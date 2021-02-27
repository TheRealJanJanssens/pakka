@php($menus = Session::get('menus'))
{!! constructAdminMenu($menus[1]['items']) !!}

