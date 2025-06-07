<?php
require_once __DIR__ . '/../database/db.class.php';
include __DIR__ . '/../header.php';

$db  = new DB();
$pdo = $db->getConnection();

$id = $_GET['id'] ?? null;
$usuario = ['nome'=>'', 'email'=>'', 'login'=>'', 'tipo'=>'cliente'];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $usuario = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = $_POST['nome'];
    $email    = $_POST['email'];
    $login    = $_POST['login'];
    $tipo     = $_POST['tipo'];
    $senha    = $_POST['senha'] ?? null;

    if ($id) {
        if (!empty($senha)) {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET nome=:nome, email=:email, login=:login, tipo=:tipo, senha=:senha WHERE id=:id";
            $params = [':nome'=>$nome, ':email'=>$email, ':login'=>$login, ':tipo'=>$tipo, ':senha'=>$hash, ':id'=>$id];
        } else {
            $sql = "UPDATE usuario SET nome=:nome, email=:email, login=:login, tipo=:tipo WHERE id=:id";
            $params = [':nome'=>$nome, ':email'=>$email, ':login'=>$login, ':tipo'=>$tipo, ':id'=>$id];
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuario (nome,email,login,senha,tipo) VALUES (:nome,:email,:login,:senha,:tipo)");
        $stmt->execute([
            ':nome'=>$nome,
            ':email'=>$email,
            ':login'=>$login,
            ':senha'=>$hash,
            ':tipo'=>$tipo
        ]);
    }

    header("Location: UsuarioList.php");
    exit;
}
?>

<h1 class="text-2xl font-bold mb-4"><?= $id ? "Editar Usuário" : "Cadastrar Usuário" ?></h1>
<form method="post" action="">
  <div class="mb-4">
    <label>Nome</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required class="w-full border p-2 rounded">
  </div>
  <div class="mb-4">
    <label>E-mail</label>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required class="w-full border p-2 rounded">
  </div>
  <div class="mb-4">
    <label>Login</label>
    <input type="text" name="login" value="<?= htmlspecialchars($usuario['login']) ?>" required class="w-full border p-2 rounded">
  </div>
  <div class="mb-4">
    <label>Senha <?= $id ? "(deixe em branco para não alterar)" : "" ?></label>
    <input type="password" name="senha" class="w-full border p-2 rounded" <?= $id ? "" : "required"?>>
  </div>
  <div class="mb-4">
    <label>Tipo</label>
    <select name="tipo" class="w-full border p-2 rounded">
      <option value="cliente" <?= $usuario['tipo']==='cliente' ? 'selected' : '' ?>>Cliente</option>
      <option value="admin"   <?= $usuario['tipo']==='admin' ? 'selected' : '' ?>>Administrador</option>
    </select>
  </div>
  <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
    <?= $id ? "Atualizar" : "Salvar" ?>
  </button>
  <a href="UsuarioList.php" class="ml-4 text-gray-600">Cancelar</a>
</form>

<?php include __DIR__ . '/../footer.php'; ?>
