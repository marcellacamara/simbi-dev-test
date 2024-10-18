import { env } from "@/common/config/env";
import LoansPageView from "@/views/LoansPage";

async function getLoans(): Promise<Loan[]> {
  const response = await fetch(`${env.API_URL}/api/loans`);
  console.log("API URL:", env.API_URL);
  if (!response.ok) {
    throw new Error("Failed to fetch loans", { cause: response.statusText });
  }
  return response.json();
}

export default async function Home() {
  const loans = await getLoans();

  return <LoansPageView loans={loans} />;
}
