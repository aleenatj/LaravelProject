@extends('layouts.app')

@section('page-title', 'Gift Cards')

@section('content')
    <div class="container-flex">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <div class="col-md">
                    <a href="{{route('admin.dashboard')}}" class="btn btn-dark">Back</a>
                </div>
                <a href="{{route('giftcard.create')}}" class="btn btn-dark">Create</a>
            </div>

            @if(Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            </div>
            @endif
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Gift Cards</h3>
                    </div>  
                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Amount</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                                <th>To Email</th>
                                <th>From</th>
                                <th>Balance</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            @if($giftcards->isNotEmpty())
                            @foreach($giftcards as $giftcard)
                            <tr>
                                <td>{{$giftcard->id}}</td>
                                <td>{{$giftcard->code}}</td>
                                <td>{{$giftcard->amount}}</td>
                                <td>{{ \Carbon\Carbon::parse($giftcard->expiry_date)->format('d M, Y')}}</td>
                                <td>{{$giftcard->status}}</td>
                                <td>{{$giftcard->to_mail}}</td>
                                <td>{{$giftcard->from}}</td>
                                <td>{{$giftcard->balance}}</td>
                                <td>{{ \Carbon\Carbon::parse($giftcard->created_at)->format('d M, Y')}}</td>
                                <td>
                                    
                                    <a href="#" onclick="deleteGiftCard('{{ $giftcard->id }}');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    <form id="delete-giftcard-form-{{ $giftcard->id }}" action="{{ route('giftcard.destroy', $giftcard->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

<script>
    function deleteGiftCard(id){
        if(confirm("Are you sure you want to delete the gift card?")){
            document.getElementById("delete-giftcard-form-" + id).submit();
        }
    }
</script>
@endsection
