{% extends "templates/base.volt" %}

{% block content %}
    <div class="card w-50">
        <div class="card-header">
            <h2 class="mb-0">Please Sign In</h2>
        </div>
      <div class="card-body">
        <form method="post" action="{{ url('signin/signin') }}">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type='email' class="form-control" placeholder="Email" id="email" name="email" autofocus>
            </div>
            <div class="form-group">
            <label for="password">Password</label>
                <input type='password' class="form-control" placeholder="Password" id="password" name="password">
            </div>
            <input type="hidden" class="form-control" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}" />
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
      </div>
    </div>
{% endblock %}