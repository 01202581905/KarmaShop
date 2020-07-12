@extends('pagesB.master')
@section('title_admin')
Manager Contact Letter | Admin | COZA
@endsection
@section('contentserver')
<div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ count($contacts) }} Letter Contact</strong>
                                <div style="display: inline-block;margin-left: 30px;">
                                <form action="{{ route('searchcontact') }}" method="GET">
                                    <input type="text" style="border-radius: 3px;box-sizing: none;box-shadow: none;border: solid 0.5px #d9d9d9;padding: 5px 30px;font-size: 14px;" name="contact" placeholder="search mail contact...">
                                    <button type="submit" style="transform: translateY(-2px);padding: 5px 20px;" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Search</button>
                                </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    @if( count($contacts) > 0 )
                                    <thead>
                                        <tr>
                                            <th width="15%;" style="text-align: center;">Name</th>
                                            <th width="15%;" style="text-align: center;">Mail</th>
                                            <th width="40%;" style="text-align: center;">Message</th>
                                            <th width="20%;" style="text-align: center;">Create At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $contacts as $contact )
                                        <tr>
                                            <td> {{ $contact->name }} </td>
                                            <td> {{ $contact->mail }}</td>
                                            <td> {{ $contact->message }}</td>
                                            <td> {{ $contact->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                        <tr>
                                            <th width="100%;" style="text-align: center;">No Letter Contact</th>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div>
@endsection