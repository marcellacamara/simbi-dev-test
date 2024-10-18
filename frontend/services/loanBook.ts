export default async function loanBook(
  bookId: string,
  LoanDate: string,
  ReturnDate: string
): Promise<void> {
  const body = JSON.stringify({
    book_id: bookId,
    loan_date: LoanDate,
    return_date: ReturnDate,
  });
  const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/loans`, {
    method: "POST",
    body,
    headers: { "Content-Type": "application/json" },
    mode: "cors",
  });
  if (!response.ok) {
    throw new Error("Failed to loan book", { cause: response.statusText });
  }
  return response.json();
}
