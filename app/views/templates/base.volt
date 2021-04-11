<!DOCTYPE html>
<html lang="en">
<head>
    {{ getTitle() }}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ this.assets.outputCss('style') }}
    {{ this.assets.outputJs('js') }}
    {% block head %}

    {% endblock %}
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
          <a class="navbar-brand" href="/">Fireball</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse d-inline-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav navbar-right">
                 <li class="nav-item">
                     <a class="nav-link" href="{{ url('signin/register') }}">Register</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ url('signin/index') }}">Signin</a>
                 </li>
            </ul>
          </div>
        </nav>

        <div class="d-flex justify-content-center">
            {{ flash.output() }}

            {% block content %}

            {% endblock %}
        </div>
    </div>
</body>
</html>