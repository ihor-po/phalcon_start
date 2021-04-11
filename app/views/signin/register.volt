{% extends "templates/base.volt" %}

{% block content %}
    <div class="card w-50">
        <div class="card-header">
            <h2 class="mb-0">Register</h2>
        </div>
      <div class="card-body">
        <form method="post" action="{{ url('signin/registration') }}">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type='email' class="form-control" placeholder="Email" id="email" name="email" autofocus>
            </div>
            <div class="form-group">
            <label for="password">Password</label>
                <input type='password' class="form-control" placeholder="Password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type='password' class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirmPassword">
            </div>
            <input type="hidden" class="form-control" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}" />
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
      </div>
    </div>
{% endblock %}