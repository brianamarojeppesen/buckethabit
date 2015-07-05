<?php foreach ($faqs as $faqs_item): ?>
     <h3><?=$faqs_item['question'] ?></h3>

     <div class="main">
          <?=$faqs_item['answer'] ?>
     </div>
     <p><a href="answer/<?=$faqs_item['id'] ?>">View article</a></p>
<?php endforeach; ?>