import { render, screen } from "@/common/utils/test-utils";
import { LoanItem } from "./LoanItem.component";
import { loanItem } from "./LoanItem.mock";

describe("<LoanItem />", () => {
  it("should render the book title", () => {
    render(<LoanItem {...loanItem} />);
    const titleElement = screen.getByText(loanItem.loaned_book.title);
    expect(titleElement).toBeInTheDocument();
  });

  it("should render the loan button", () => {
    render(<LoanItem {...loanItem} />);
    const buttonElement = screen.getByRole("button", { name: /Devolver/i });
    expect(buttonElement).toBeInTheDocument();
  });

  it("should display the full title in a tooltip", async () => {
    render(<LoanItem {...loanItem} />);
    const tooltipElement = screen.getByText(loanItem.loaned_book.title);
    expect(tooltipElement).toBeInTheDocument();
  });
});
