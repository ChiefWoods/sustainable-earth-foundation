<table>
  <thead>
    <tr class="column">
      <th class="table-col">Username</th>
      <th class="table-col">Email</th>
      <th class="table-col">Phone Number</th>
      <th class="table-col">Points</th>
      <th class="table-col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>user1</td>
      <td>user@gmail.com</td>
      <td>0123456789</td>
      <td>4567</td>
      <td class="edit-delete">
        <button id="edit-btn">
          <img src="../../assets/icons/edit/edit.svg" alt="Edit" class="icon">
        </button>
        <button id="delete-btn">
          <img src="../../assets/icons/delete/delete.svg" alt="Delete" class="icon">
        </button>
      </td>
    </tr>
    <?php include '../components/no_results.php'; ?>
  </tbody>
</table>