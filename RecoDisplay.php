<?php
        include 'connection.php';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['sort']) ? $_GET['sort'] : 'none';
        $page_limit = 5;
        $offset = ($page - 1)*$page_limit;
        $sql = "SELECT COUNT(*) AS total FROM Book";
        $total_book = $conn->query($sql);
        $total_book_count = $total_book->fetch_assoc()['total'];
        $total_page = ceil($total_book_count/$page_limit);
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        // $category = "SELECT * FROM category_rela;";
        // $cate = $conn->query($category);
        // if ($order == 'none'){
        //     $query = "SELECT * FROM Book LIMIT $page_limit OFFSET $offset";
        // }
        // else{
        //     $query = "SELECT * FROM Book ORDER BY bookName LIMIT $page_limit OFFSET $offset ". ($order == 'dcs' ? 'DESC' : 'ASC');
        //}
        // $query = "SELECT * FROM Book ORDER BY id OFFSET $offset ROWS FETCH NEXT $page_limit ROWS ONLY;";
        // $query = "SELECT * FROM Book";

        $query = "SELECT Book.*, category_rela.catename
            FROM Book
            LEFT JOIN category_rela ON Book.id = category_rela.bookid";

        if ($search != ''){
            $query .= " WHERE bookName LIKE '%$search%' ";
        }
        if ($order == 'asc') {
            $query .= " ORDER BY bookName ASC";
        } elseif ($order == 'desc') {
            $query .= " ORDER BY bookName DESC";
        }
        $query .= " LIMIT $page_limit OFFSET $offset";
        $result = $conn->query($query);


        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                echo "
                <li>
                <div class='bookcard'>
                    <img src='" .$row["img_path"] ."' class='recoimg'>
                    <div class='book-details'>
                        <h3>" ." " .$row["bookName"] ."</h3>
                        <p class='author'>Imani Perry</p>
                        <p class='category'>Category: " .$row["catename"] ."</p>
                        <p class='description'>"
                            .$row["describ"]
                        ."</p>
                    </div>
                </div>
            </li>";
            }
        }
        ?>