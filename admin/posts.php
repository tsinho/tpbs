<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
include 'head.php';

// 删除文章
if (isset($_POST['delete_post'])) {
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM posts WHERE id=$id");
}

// 获取文章数据
$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
?>
            <div class="page-header">
                <h1>文章管理</h1>
                <a style="text-decoration:none" href="post_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> 新建文章</a>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h2>文章列表</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="30">
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>作者</th>
                                    <th>浏览量</th>
                                    <th>发布时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="post-checkbox">
                                    </td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td>
                                        <div style="display:flex;align-items:center;justify-content:center;gap:5px">
                                            <?php if($row['fm']): ?>
                                            <img src="<?php echo htmlspecialchars($row['fm']); ?>" width="40" height="40" class="rounded mr-3" style="object-fit: cover;border-radius:7px">
                                            <?php endif; ?>
                                            <div>
                                                <div class="font-weight-600"><?php echo htmlspecialchars($row['title']); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display:flex;align-items:center;justify-content:center;gap:5px">
                                            <img style="border-radius:50%" src="https://q1.qlogo.cn/g?b=qq&nk=<?php echo $row['author_qq']; ?>&s=40" width="30" height="30" class="rounded-circle mr-2">
                                            <?php echo htmlspecialchars($row['author']); ?>
                                        </div>
                                    </td>
                                    <td><?php echo $row['view']; ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($row['time'])); ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="post_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete_post" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            
            <style>
                .table {
                    width: 100%;
                    border-collapse: separate;
                    border-spacing: 0;
                }
                .table th {
                    background: #f8fafd;
                    color: #5a6a85;
                    font-weight: 600;
                    padding: 15px;
                    border-top: 1px solid #f1f4f9;
                    position: sticky;
                    top: 0;
                }
                .table td {
                    padding: 15px;
                    border-top: 1px solid #f1f4f9;
                    color: #5a6a85;
                }
                .table tbody tr:hover {
                    background: #fafcff;
                }
                .bulk-form {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
            </style>
            
            <style>
                .font-weight-600 {
                    font-weight: 600;
                }
                .gap-2 {
                    gap: 10px;
                }
                .btn-outline-primary {
                    color: var(--primary);
                    border-color: var(--primary);
                }
                .btn-outline-primary:hover {
                    background: var(--primary);
                    color: white;
                }
                .btn-outline-danger {
                    color: #ff4757;
                    border-color: #ff4757;
                }
                .btn-outline-danger:hover {
                    background: #ff4757;
                    color: white;
                }
            </style>
<?php include 'foot.php'; ?>