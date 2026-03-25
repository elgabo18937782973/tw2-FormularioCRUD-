<?php
require 'users/users.php';

$users = getUsers();

include 'partials/header.php';
?>


<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-users"></i> Gestión de Usuarios</h2>
        <a class="btn btn-success" href="create.php">
            <i class="fas fa-user-plus"></i> Crear Nuevo Usuario
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th><i class="fas fa-image"></i> Imagen</th>
                <th><i class="fas fa-user"></i> Nombre</th>
                <th><i class="fas fa-at"></i> Usuario</th>
                <th><i class="fas fa-envelope"></i> Email</th>
                <th><i class="fas fa-phone"></i> Teléfono</th>
                <th><i class="fas fa-globe"></i> Sitio Web</th>
                <th><i class="fas fa-cog"></i> Acciones</th>
            </tr>
            </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?php if (isset($user['extension'])): ?>
                        <img style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;" src="<?php echo "users/images/{$user['id']}.{$user['extension']}" ?>" alt="<?php echo htmlspecialchars($user['name']) ?>">
                    <?php else: ?>
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 24px;">
                            <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                        </div>
                    <?php endif; ?>
                </td>
                <td><strong><?php echo htmlspecialchars($user['name']) ?></strong></td>
                <td><?php echo htmlspecialchars($user['username']) ?></td>
                <td>
                    <?php if (!empty($user['email'])): ?>
                        <a href="mailto:<?php echo htmlspecialchars($user['email']) ?>"><?php echo htmlspecialchars($user['email']) ?></a>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (!empty($user['phone'])): ?>
                        <a href="tel:<?php echo htmlspecialchars($user['phone']) ?>"><?php echo htmlspecialchars($user['phone']) ?></a>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (!empty($user['website'])): ?>
                        <a target="_blank" href="http://<?php echo htmlspecialchars($user['website']) ?>" class="text-primary">
                            <i class="fas fa-external-link-alt"></i> <?php echo htmlspecialchars($user['website']) ?>
                        </a>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="view.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-info" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="update.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-secondary" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="delete.php" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

<?php include 'partials/footer.php' ?>

