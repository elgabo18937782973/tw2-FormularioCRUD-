<?php
include 'partials/header.php';
require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
    include "partials/not_found.php";
    exit;
}
$userId = $_GET['id'];

$user = getUserById($userId);
if (!$user) {
    include "partials/not_found.php";
    exit;
}

?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0"><i class="fas fa-user-circle"></i> Ver Usuario: <b><?php echo htmlspecialchars($user['name']) ?></b></h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <?php if (isset($user['extension'])): ?>
                        <img src="users/images/<?php echo $user['id'] ?>.<?php echo $user['extension'] ?>" 
                             alt="<?php echo htmlspecialchars($user['name']) ?>" 
                             class="img-thumbnail rounded-circle" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <div style="width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 60px; margin: 0 auto;">
                            <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-center mb-4">
                <a class="btn btn-secondary" href="update.php?id=<?php echo $user['id'] ?>">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form style="display: inline-block" method="POST" action="delete.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                    <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
                <a class="btn btn-info" href="index.php">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th width="200"><i class="fas fa-user"></i> Nombre:</th>
                    <td><strong><?php echo htmlspecialchars($user['name']) ?></strong></td>
                </tr>
                <tr>
                    <th><i class="fas fa-at"></i> Usuario:</th>
                    <td><?php echo htmlspecialchars($user['username']) ?></td>
                </tr>
                <tr>
                    <th><i class="fas fa-envelope"></i> Email:</th>
                    <td>
                        <?php if (!empty($user['email'])): ?>
                            <a href="mailto:<?php echo htmlspecialchars($user['email']) ?>">
                                <?php echo htmlspecialchars($user['email']) ?>
                            </a>
                        <?php else: ?>
                            <span class="text-muted">No especificado</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th><i class="fas fa-phone"></i> Teléfono:</th>
                    <td>
                        <?php if (!empty($user['phone'])): ?>
                            <a href="tel:<?php echo htmlspecialchars($user['phone']) ?>">
                                <?php echo htmlspecialchars($user['phone']) ?>
                            </a>
                        <?php else: ?>
                            <span class="text-muted">No especificado</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th><i class="fas fa-globe"></i> Sitio Web:</th>
                    <td>
                        <?php if (!empty($user['website'])): ?>
                            <a target="_blank" href="http://<?php echo htmlspecialchars($user['website']) ?>">
                                <i class="fas fa-external-link-alt"></i> <?php echo htmlspecialchars($user['website']) ?>
                            </a>
                        <?php else: ?>
                            <span class="text-muted">No especificado</span>
                        <?php endif; ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include 'partials/footer.php' ?>
