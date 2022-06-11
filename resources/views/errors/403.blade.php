@extends('errors::minimal')

@section('title', __('Az engedély megtagadva'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
