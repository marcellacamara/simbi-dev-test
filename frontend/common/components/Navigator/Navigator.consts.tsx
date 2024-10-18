import LibraryBooksIcon from "@mui/icons-material/LibraryBooks";
import AssignmentTurnedInIcon from "@mui/icons-material/AssignmentTurnedIn";

export const categories = [
  {
    id: "Gestão",
    children: [
      {
        id: "Livros",
        icon: <LibraryBooksIcon />,
        active: true,
        urlPath: "/",
      },
      {
        id: "Empréstimos",
        icon: <AssignmentTurnedInIcon />,
        urlPath: "/loans",
      },
    ],
  },
];

export const item = {
  py: "2px",
  px: 3,
  color: "rgba(255, 255, 255, 0.7)",
  "&:hover, &:focus": {
    bgcolor: "rgba(255, 255, 255, 0.08)",
  },
};

export const itemCategory = {
  boxShadow: "0 -1px 0 rgb(255,255,255,0.1) inset",
  py: 1.5,
  px: 3,
};
