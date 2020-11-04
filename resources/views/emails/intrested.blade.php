<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>MyBigAsianWedding Subscription Email</h2>
    <p>{{ $data['fname'] }}</p>
    <p>{{ $data['email'] }}</p>
    <p>{{ $data['phone'] }}</p>
    <p>{{ $data['best_time_to_call'] }}</p>
    <p>{{ implode(", ", $data['intrested_in']) }}</p>
  </body>
</html>
