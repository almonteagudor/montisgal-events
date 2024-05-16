namespace montisgal_events.domain.Groups;

public interface IGroupRepository
{
    public Task<Group?> GetGroup(Guid id, Guid ownerId);
    
    public Task<List<Group>> GetGroups(Guid ownerId);

    public Task<bool> InsertGroup(Group group);
    
    public Task<bool> UpdateGroup(Group group);
    
    public Task<bool> DeleteGroup(Group group);
}