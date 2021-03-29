{% extends "templates/base.volt" %}

{% block content %}
    <form method="post" action="{{ url('signin/signin') }}">
        <h2>Please Sign In</h2>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type='email' autofocus placeholder="Email" id="email" name="email">
        </div>
        <div class="form-group">
        <label for="password">Password</label>
            <input type='password' placeholder="Password" id="password" name="password">
        </div>
        <button type="submit">Sign In</button>
    </form>
{% endblock %}