<x-layout>
    <h2>Welcome!</h2>

    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf
         <x-form-errors/>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Log In</button>
    </form>

    <div class="form-footer">
        Don't have an account?
        <a href="register">Register</a>
    </div>
</x-layout>