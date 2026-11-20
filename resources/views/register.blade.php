<x-layout>
    <h2>Create New Account</h2>
    <form method = "POST" action="{{ route('register.store') }}">
        @csrf
        
        <input type="text" name="name" placeholder="Name"/>
         <input type="text" name="username" placeholder="Username"/>
        <input type="email" name="email" placeholder="Email"/>
        <input type="password" name="password" placeholder="Password"/>

        <button type="submit">Register</button>
    </form>

    <x-form-errors/>

    <div class="form-footer">
        Already have an account?
        <a href="login">Log In</a>
    </div>
</x-layout>