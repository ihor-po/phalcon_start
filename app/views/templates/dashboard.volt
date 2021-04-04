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
    <div class="navbar navbar-default">
        <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
          <a class="navbar-brand" href="{{ url('dashboard/') }}">Fireball</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="{{ url('dashboard/') }}">Dashboard <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('project/') }}">Projects</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('account/') }}">Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index/signout/">Signout</a>
              </li>
            </ul>
          </div>
        </nav>
        </div>
    </div>

    {{ flash.output() }}

    {% block content %}

    {% endblock %}
</body>
</html>