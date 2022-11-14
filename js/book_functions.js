function addToList(element) {
  console.log(element.parentNode.parentNode.children[2].innerHTML);
  let book = element.parentNode.parentNode;
  let id = book.children[0].innerHTML;
  let title = book.children[2].innerHTML;
  let publisher = book.children[4].innerHTML;
  let price = book.children[7].innerHTML;
  let booklistForm = document.getElementById("booklist");
  let entry = document.createElement('div');
  let numberOfEntries = booklistForm.children.length;

  let bookId = document.createElement('input');
  bookId.setAttribute("type", "text");
  bookId.setAttribute("name", ("id_" + numberOfEntries))
  bookId.setAttribute("value", id);
  bookId.setAttribute("disabled", "")
  entry.appendChild(bookId);

  let bookTitle = document.createElement('input');
  bookTitle.setAttribute("type", "text");
  bookTitle.setAttribute("name", ("title_" + numberOfEntries))
  bookTitle.setAttribute("value", title);
  bookTitle.setAttribute("disabled", "")
  entry.appendChild(bookTitle);

  let bookPublisher = document.createElement('input');
  bookPublisher.setAttribute("type", "text");
  bookPublisher.setAttribute("name", ("publisher_" + numberOfEntries))
  bookPublisher.setAttribute("value", publisher);
  bookPublisher.setAttribute("disabled", "")
  entry.appendChild(bookPublisher);

  let bookPrice = document.createElement('input');
  bookPrice.setAttribute("type", "text");
  bookPrice.setAttribute("name", ("price_" + numberOfEntries))
  bookPrice.setAttribute("value", price);
  bookPrice.setAttribute("disabled", "")
  entry.appendChild(bookPrice);

  let bookQuantity = document.createElement('input');
  bookQuantity.setAttribute("type", "number")
  bookQuantity.setAttribute("name", ("quantity_" + numberOfEntries));
  bookQuantity.setAttribute("value", 1);
  entry.appendChild(bookQuantity);

  booklistForm.insertBefore(entry, document.getElementById("booklist_submit"));
  booklistForm.hidden = false;



}
