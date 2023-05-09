<?php
use App\Model\Entity\User;
?>
<p>Listing des utilisateurs</p>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>email</th>
            <th>pseudo</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody><?php
        foreach($params['users'] as $user) {
            /* @var User $user */ ?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getPseudo() ?></td>
                <td><a href="/user/delete/<?= $user->getId() ?>">Supprimer</a></td>
            </tr> <?php
        } ?>
    </tbody>
</table>
