<h1><?= h($employees->title) ?></h1>
<p><?= h($employees->body) ?></p>
<p><small>Created: <?= $employees->created->format(DATE_RFC850) ?></small></p>