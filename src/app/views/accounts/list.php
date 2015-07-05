<?php foreach ($accounts_response as $account): ?>
     <h3><?=$account['username'] ?></h3>

     <div>
          <ul>
               <li><?=$account['first_name']; ?></li>
               <li><?=$account['last_name']; ?></li>
          </ul>
     </div>
     <p><a href="/admin/accounts/<?=$account['username'] ?>">View user</a></p>
<?php endforeach; ?>