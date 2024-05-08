<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1"
                            class="text-gray-800 dark:text-gray-200 leading-tight">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                            id="exampleInputEmail1">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Example multiple select</label>
                        <select name="role_id" class="form-control" id="exampleFormControlSelect2">
                            @foreach ($roles as $role)
                                <option value="{{$role['id']}}" @if($user->hasRole($role['name'])) selected @endif>{{$role['name']}}</option>
                                
                            @endforeach
                   
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
