@extends('layouts.admin')

@section('content')
    ﻿ <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">{{__('messages.home')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('messages.deliveryMethods')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{__('messages.editDeliveryMethod')}}
                                        <span class="badge badge-pill badge-danger">{{--{{$mainCategory->name}}--}}</span> </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('update.shipping',$shippingMethod->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <input name="id" value="{{$shippingMethod->id}}" type="hidden">

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>{{__('messages.deliveryMethodData')}} </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> {{__('messages.deliveryType')}}</label>
                                                            <input type="text"
                                                                   value="{{$shippingMethod->value}}"
                                                                   id="value"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="value">
                                                            @error('value')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> {{__('messages.deliveryValue')}}</label>
                                                            <input type="number"
                                                                   value="{{$shippingMethod->plain_value}}"
                                                                   id="plain_value"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="plain_value">
                                                            @error('plain_value')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                 {{--   <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"
                                                                   value="--}}{{--{{$mainCategory->active}}--}}{{--"
                                                                   name="status"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success" checked
                                                                   --}}{{--@if($mainCategory->active == 1) checked @endif--}}{{--/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">{{__('messages.status')}}</label>
                                                            @error('status')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>--}}
                                                </div>

                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{__('messages.undo')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{__('messages.update')}}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection


