namespace montisgal_events.mvc.Models.Groups;

public class IndexViewModel(List<domain.Group.Group> groups)
{
    public List<domain.Group.Group> Groups { get; set; } = groups;
}