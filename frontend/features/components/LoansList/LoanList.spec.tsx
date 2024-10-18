import { render, screen } from "@/common/utils/test-utils";
import { LoansList } from "./LoansList.component";
import { loansList } from "./LoansList.mock";

const { loans } = loansList;

describe("<LoansList />", () => {
  it("renders BooksList component", () => {
    render(<LoansList {...loansList} />);

    expect(screen.getByText(loans[0].loaned_book.title)).toBeInTheDocument();
    expect(screen.getByText(loans[1].loaned_book.title)).toBeInTheDocument();
  });
});
