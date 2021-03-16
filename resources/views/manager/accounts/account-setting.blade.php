@extends('manager.layouts.app')

@section('title', 'Account Setting')
@section('page-title', 'Account Setting')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card shadow">
            <div class="card-header">Update Account</div>
            <div class="card-body">
                <form action="{{ route('account.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $account->id }}">
                    <input type="hidden" name="role" value="{{ $role }}">
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" value="{{ $account->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" value="{{ $account->email }}" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Kosongkan bila tidak mengubah password.">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-primary pl-4 pr-4 rounded-pill" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection