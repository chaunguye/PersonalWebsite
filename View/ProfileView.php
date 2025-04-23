
<div class="profile-container">
  <h2>Hello, <?= htmlspecialchars($user['firstName']) ?> 👋</h2>
  
  <img src="<?= htmlspecialchars($user['img_path']) ?>" alt="Profile Picture" class="profile-image">
  <p style="font-size: 0.9em; color: #777;">Username: <?= htmlspecialchars($user['userName']) ?> (not editable)</p>

  <form action="../Controller/ProfileController.php" method="POST" enctype="multipart/form-data">
    <label>First Name:</label>
    <input type="text" name="firstName" value="<?= htmlspecialchars($user['firstName']) ?>">

    <label>Last Name:</label>
    <input type="text" name="lastName" value="<?= htmlspecialchars($user['lastName']) ?>">

    <label>Date of Birth:</label>
    <input type="date" name="dob" value="<?= htmlspecialchars($user['dob']) ?>">

    <label>Sex (M/F/U):</label>
    <input type="text" name="sex" value="<?= htmlspecialchars($user['sex']) ?>">

    <label>Bio:</label>
    <textarea name="bio"><?= htmlspecialchars($user['bio']) ?></textarea>

    <label>Change Profile Picture:</label>
    <input type="file" name="img">

    <button type="submit">Update Profile</button>
  </form>

  
</div>