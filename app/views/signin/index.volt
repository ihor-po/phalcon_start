{% extends "templates/base.volt" %}

{% block content %}
    <form method="post">
        <h2>Please Sign In</h2>
        <input type='email' autofocus placeholder="Email">
        <input type='password' placeholder="Password">
        <button type="submit">SignIn</button>
    </form>
{% endblock %}