@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <ul id="users"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        window.axios.get('/api/users')
                    .then((response) => {
                        const userel = document.getElementById('users')
                        let users = response.data

                        users.forEach((user)=> {
                            let el =  document.createElement('li')
                            el.setAttribute('id', 'user-' + user.id)
                            el.innerText = user.name
                            userel.appendChild(el)
                        })

                    })

    </script>
    <script>
        Echo.channel("users")
        .listen("UserCreated",(e)=>{
            const userel = document.getElementById('users')

            let el =  document.createElement('li')
            el.setAttribute('id', e.user.id)
            el.innerText = e.user.name
            userel.appendChild(el)
        })
        .listen("UserUpdated",(e)=>{
            const el = document.getElementById('user-'+e.user.id)
            el.innerText = e.user.name
        })
        .listen("UserDeleted",(e)=>{
            const el = document.getElementById('user-'+e.user.id)
            el.parentNode.removeChild(el)
        })
    </script>

@endpush
