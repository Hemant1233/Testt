<?php
function getCaptchaKey() {
    $url = "https://www.count-money.top/httpapi/coin/captcha/get?oldKey=captcha:dummy";
    $headers = [
        "User-Agent: Mozilla/5.0 (Linux; Android 13; CPH2373)",
        "x-requested-with: mark.via.gp"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // 🔁 Public proxy for GET
    curl_setopt($ch, CURLOPT_PROXY, "190.61.88.147:8080");

    $response = curl_exec($ch);
    curl_close($ch);

    preg_match('/captcha:[a-z0-9]+/i', $response, $matches);
    return $matches[0] ?? null;
}

function randomIP() {
    return rand(1,255) . '.' . rand(0,255) . '.' . rand(0,255) . '.' . rand(1,255);
}

$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $optCode = $_POST['optCode'];
    $refCode = $_POST['refCode'];
    $optKey  = $_POST['optKey'];

    $mobile = "9" . rand(100000000, 999999999);
    $password = "Salim@123";

    $postData = json_encode([
        "name" => $mobile,
        "loginName" => $mobile,
        "password" => $password,
        "optKey" => $optKey,
        "optCode" => $optCode,
        "refCode" => $refCode
    ]);

    $ch = curl_init("https://www.count-money.top/httpapi/system/register");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json;charset=UTF-8",
        "User-Agent: Mozilla/5.0 (Linux; Android 13; CPH2373)",
        "x-requested-with: mark.via.gp",
        "origin: https://www.count-money.top",
        "referer: https://www.count-money.top",
        "X-Forwarded-For: " . randomIP()
    ]);

    // 🔁 Public proxy for POST
    curl_setopt($ch, CURLOPT_PROXY, "190.61.88.147:8080");

    $result = curl_exec($ch);
    curl_close($ch);
}

$optKey = getCaptchaKey();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Count Money</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: sans-serif; background: #111; color: #fff; text-align: center; padding: 20px; }
    input, button { padding: 10px; margin: 8px; border: none; border-radius: 5px; width: 80%; font-size: 16px; }
    button { background: limegreen; color: black; font-weight: bold; cursor: pointer; }
    .result { background: #222; padding: 15px; margin-top: 20px; border-radius: 10px; }
  </style>
</head>
<body>
  <h2>Refer Bypass Panel</h2>

  <form method="POST">
    <input type="hidden" name="optKey" value="<?= htmlspecialchars($optKey) ?>">
    <img src="https://www.count-money.top/httpapi/coin/captcha/draw/<?= urlencode($optKey) ?>" alt="CAPTCHA" width="200"><br>
    <input type="text" name="optCode" placeholder="Enter Captcha Code" required><br>
    <input type="text" name="refCode" placeholder="Enter Refer Code" required><br>
    <button type="submit">Submit Refer</button>
  </form>

  <?php if ($result): ?>
    <div class="result">
      <h3>Server Response</h3>
      <pre><?= htmlspecialchars($result) ?></pre>
    </div>
  <?php endif; ?>
</body>
</html>