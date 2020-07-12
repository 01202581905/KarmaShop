@extends('pagesB.master')
@section('title_admin')
Manager User | Admin | COZA
@endsection
@section('contentserver')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content" style="overflow-x: scroll;">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong id="quantityuser">{{ count($users) }} </strong><strong class="card-title"> {{ $name }}</strong>
                                <div style="display: inline-block;margin-left: 30px;">
                                <form action="{{ route('searchuser') }}" method="GET">
                                    @if( $name == 'User' )
                                        <input type="hidden" name="t" value="users" style="display: none;">
                                    @elseif( $name == 'User Lock' )
                                        <input type="hidden" name="t" value="lock" style="display: none;">
                                    @endif
                                    <input type="text" style="border-radius: 3px;box-sizing: none;box-shadow: none;border: solid 0.5px #d9d9d9;padding: 5px 30px;font-size: 14px;" name="mailuser" placeholder="search user mail...">
                                    <button type="submit" style="transform: translateY(-2px);padding: 5px 20px;" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Search</button>
                                </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    @if( count($users) > 0 )
                                    <thead>
                                        <tr>
                                            <th width="15%;" style="text-align: center;">Name User</th>
                                            <th width="12%;" style="text-align: center;">Mail</th>
                                            <th width="12%;" style="text-align: center;">Phone</th>
                                            <th width="32%;" style="text-align: center;">Address</th>
                                            <th width="8%;" style="text-align: center;">Shop</th>
                                            <th width="8%;" style="text-align: center;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $users as $user )
                                        <tr class="tr-user user-{{ $user->id }}">
                                            <td> {{ $user->name }} </td>
                                            <td class="mailuser"> {{ $user->email }}</td>
                                            <td> {{ $user->phone }}</td>
                                            <td> {{ $user->address }}</td>
                                            <td> @if( $user->status_shop == 1 ) Actice @else Deactive @endif</td>
                                            <td style="text-align: center;">
                                                @if( $user->status == 1 )
                                                <a class="buttonlockuser" datauser="{{ $user->id }}" href="javascript:void(0)" style="color: #fff;background-color: red;padding: 5px 10px;border-radius: 5px;">Lock</a>
                                                @else
                                                <a class="buttonunlockuser" datauser="{{ $user->id }}" href="javascript:void(0)" style="color: #fff;background-color: #28a745;padding: 5px 10px;border-radius: 5px;">UnLock</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                        <tr>
                                            <th width="100%;" style="text-align: center;">No User</th>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div>
<script type="text/javascript">
        jQuery(document).ready(function(){

            jQuery('.buttonlockuser').click(function(){
                var datauser = jQuery(this).attr('datauser');
                var result = confirm("Want to lock user : "+ jQuery(this).parent('td').parent('tr').find('.mailuser').html());
                if( result )
                {
                    console.log(datauser);
                    jQuery.ajax({
                        url: '/Karma/serverkarma/lockuser',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            'iduser': datauser
                        },
                        success: function(data){
                            alert('Lock user :'+jQuery(this).parent('td').parent('tr').find('.mailuser').html()+'Success !!');
                            jQuery('.user-'+datauser).remove();
                            var count = data['count'];
                            jQuery('#quantityuser').html(count);
                            var quan = jQuery('.tr-user').length;
                            if( quan == 0 )
                            {
                                jQuery('.card-body').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No User !</p>');
                            }
                        }
                    });
                }
            });

            jQuery('.buttonunlockuser').click(function(){
                var datauser = jQuery(this).attr('datauser');
                var result = confirm("Want to Unlock user : "+ jQuery(this).parent('td').parent('tr').find('.mailuser').html());
                if( result )
                {
                    console.log(datauser);
                    jQuery.ajax({
                        url: '/Karma/serverkarma/unlockuser',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            'iduser': datauser
                        },
                        success: function(data){
                            alert('UnLock user :'+jQuery(this).parent('td').parent('tr').find('.mailuser').html()+'Success !!');
                            jQuery('.user-'+datauser).remove();
                            var count = data['count'];
                            jQuery('#quantityuser').html(count);
                            var quan = jQuery('.tr-user').length;
                            if( quan == 0 )
                            {
                                jQuery('.card-body').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No User !</p>');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection