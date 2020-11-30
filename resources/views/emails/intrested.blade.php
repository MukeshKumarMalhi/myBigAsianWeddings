<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>MyBigAsianWedding Subscription Email</h2>
    <p>Name: {{ $data['full_name'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Phone: {{ $data['phone'] }}</p>
    <p>Best time to call: {{ $data['best_time_to_call'] }}</p>
    <p>Intrested in: {{ implode(", ", $data['intrested_in']) }}</p>
  </body>
</html>
