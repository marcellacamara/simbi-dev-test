type Author = {
  id: string;
  name: string;
};

type Book = {
  id: string;
  title: string;
  author: Author;
  publisher: string;
  coverUrl?: string;
  createdAt: string;
  updatedAt: string;
};

type Loan = {
  id: string;
  loanedBook: Book;
  LoanDate: string;
  ReturnDate: string;
};

type BookPan = {
  title: string;
  authorFirstName: string;
  authorLastName: string;
  publisher: string;
};
