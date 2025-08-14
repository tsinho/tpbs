<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 * love msq
 */
 
include 'head.php';

if (isset($_POST['delete_comment'])) {
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM comments WHERE id=$id");
    echo "<script>alert('评论删除成功');</script>";
}

if (isset($_POST['bulk_delete']) && isset($_POST['comment_ids'])) {
    $ids = implode(',', array_map('intval', $_POST['comment_ids']));
    $conn->query("DELETE FROM comments WHERE id IN ($ids)");
    echo "<script>alert('已删除选中的评论');</script>";
}

$result = $conn->query("SELECT * FROM comments ORDER BY id DESC");
?>
            <div class="page-header">
                <h1>评论管理</h1>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h2>评论列表</h2>
                    <form method="POST" class="bulk-form" id="bulkDeleteForm">
                        <input type="hidden" name="bulk_delete" value="1">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> 批量删除</button>
                    </form>
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
                                    <th>昵称</th>
                                    <th>QQ</th>
                                    <th>内容</th>
                                    <th>时间</th>
                                    <th>IP</th>
                                    <th>文章ID</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="comment_ids[]" value="<?php echo $row['id']; ?>" class="comment-checkbox">
                                    </td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td>
                                        <div style="display:flex;align-items:center;justify-content:center;gap:5px">
                                            <img style="border-radius:50%" src="https://q1.qlogo.cn/g?b=qq&nk=<?php echo $row['qq']; ?>&s=40" width="30" height="30" class="rounded-circle mr-2">
                                            <?php echo htmlspecialchars($row['name']); ?>
                                        </div>
                                    </td>
                                    <td><?php echo $row['qq']; ?></td>
                                    <td><?php echo mb_substr(htmlspecialchars($row['content']), 0, 30, 'utf-8'); ?>...</td>
                                    <td><?php echo date('m-d H:i', strtotime($row['time'])); ?></td>
                                    <td><?php echo $row['ip']; ?></td>
                                    <td><?php echo $row['pid']; ?></td>
                                    <td>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_comment" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
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
            
            <script>
                document.getElementById('selectAll').addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.comment-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
                
                document.getElementById('bulkDeleteForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const checkedBoxes = document.querySelectorAll('.comment-checkbox:checked');
                    if (checkedBoxes.length === 0) {
                        alert('请至少选择一条评论');
                        return;
                    }
                    
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '';
                    
                    const bulkDeleteInput = document.createElement('input');
                    bulkDeleteInput.type = 'hidden';
                    bulkDeleteInput.name = 'bulk_delete';
                    bulkDeleteInput.value = '1';
                    form.appendChild(bulkDeleteInput);
                    
                    checkedBoxes.forEach(checkbox => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'comment_ids[]';
                        input.value = checkbox.value;
                        form.appendChild(input);
                    });
                    
                    if (confirm('确定要删除选中的 ' + checkedBoxes.length + ' 条评论吗？')) {
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            </script>
<?php include 'foot.php'; ?>
