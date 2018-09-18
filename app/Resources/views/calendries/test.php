{% set start_date = '01-06-2014' %}
{% set end_date = '05-06-2014' %}
{% for x in range(start_date|date('U'), end_date|date('U'), 86400 ) %}
{{ x|date('d/m/Y') }}<br>
{% endfor %}